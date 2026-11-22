<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGalleryItemRequest;
use App\Http\Requests\Admin\UpdateGalleryItemRequest;
use App\Models\GalleryItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $items = GalleryItem::orderBy('sort_order')
            ->latest('id')
            ->paginate(12);

        return view('admin.gallery.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin.gallery.create');
    }

    public function store(StoreGalleryItemRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['image']);
        $data['image_path'] = $request->file('image')->store('gallery', 'public');

        GalleryItem::create($data);

        return redirect()
            ->route('admin.gallery.index')
            ->with('status', 'Gallery photo added.');
    }

    public function edit(GalleryItem $gallery): View
    {
        return view('admin.gallery.edit', ['item' => $gallery]);
    }

    public function update(UpdateGalleryItemRequest $request, GalleryItem $gallery): RedirectResponse
    {
        $data = $request->safe()->except(['image']);

        if ($request->hasFile('image')) {
            if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $data['image_path'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($data);

        return redirect()
            ->route('admin.gallery.index')
            ->with('status', 'Gallery photo updated.');
    }

    public function destroy(GalleryItem $gallery): RedirectResponse
    {
        if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();

        return redirect()
            ->route('admin.gallery.index')
            ->with('status', 'Gallery photo deleted.');
    }
}
