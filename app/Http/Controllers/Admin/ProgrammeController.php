<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ContentStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProgrammeRequest;
use App\Http\Requests\Admin\UpdateProgrammeRequest;
use App\Models\Programme;
use App\Models\ProgrammeCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProgrammeController extends Controller
{
    public function index(): View
    {
        $programmes = Programme::with('category')
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate(15);

        return view('admin.programmes.index', compact('programmes'));
    }

    public function create(): View
    {
        $categories = ProgrammeCategory::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.programmes.create', compact('categories'));
    }

    public function store(StoreProgrammeRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? null, $data['title']);
        $data['status'] = $data['is_published'] ? ContentStatus::Published : ContentStatus::Draft;

        Programme::create($data);

        return redirect()
            ->route('admin.programmes.index')
            ->with('status', 'Programme created successfully.');
    }

    public function edit(Programme $programme): View
    {
        $categories = ProgrammeCategory::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.programmes.edit', compact('programme', 'categories'));
    }

    public function update(UpdateProgrammeRequest $request, Programme $programme): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? null, $data['title'], $programme->id);
        $data['status'] = $data['is_published'] ? ContentStatus::Published : ContentStatus::Draft;

        $programme->update($data);

        return redirect()
            ->route('admin.programmes.index')
            ->with('status', 'Programme updated successfully.');
    }

    public function destroy(Programme $programme): RedirectResponse
    {
        $programme->delete();

        return redirect()
            ->route('admin.programmes.index')
            ->with('status', 'Programme deleted.');
    }

    private function uniqueSlug(?string $providedSlug, string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($providedSlug ?: $title) ?: 'programme';
        $slug = $base;
        $counter = 2;

        while (
            Programme::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$base}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
