<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMediaRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MediaController extends Controller
{
    public function index(): View
    {
        $disk = Storage::disk('public');
        $files = collect($disk->allFiles())
            ->filter(fn (string $path): bool => preg_match('/\.(jpg|jpeg|png|webp)$/i', $path) === 1)
            ->map(fn ($path) => [
                'path' => $path,
                'url' => $disk->url($path),
                'size_kb' => round($disk->size($path) / 1024, 1),
                'last_modified' => date('d M Y, H:i', $disk->lastModified($path)),
            ])
            ->values();

        return view('admin.media.index', compact('files'));
    }

    public function store(StoreMediaRequest $request): RedirectResponse
    {
        $folder = $request->input('folder', 'media');
        $request->file('file')->store($folder, 'public');

        return redirect()
            ->route('admin.media.index')
            ->with('status', 'Image uploaded to media library.');
    }

    public function destroy(string $filename): RedirectResponse
    {
        abort_if(str_contains($filename, '..'), 403);

        if (Storage::disk('public')->exists($filename)) {
            Storage::disk('public')->delete($filename);
        }

        return redirect()
            ->route('admin.media.index')
            ->with('status', 'Media file deleted.');
    }
}
