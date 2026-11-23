<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogPostRequest;
use App\Http\Requests\Admin\UpdateBlogPostRequest;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $posts = BlogPost::with(['category', 'author'])
            ->latest('id')
            ->paginate(15);

        return view('admin.blog.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = BlogCategory::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.blog.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogPostRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['cover_image']);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? null, $data['title']);
        $data['author_id'] = $request->user()->id;
        $data['published_at'] = $data['is_published'] ? now() : null;

        if ($request->hasFile('cover_image')) {
            $data['cover_image_path'] = $request->file('cover_image')->store('blog', 'public');
        }

        BlogPost::create($data);

        return redirect()
            ->route('admin.blog.index')
            ->with('status', 'Wellness article created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPost $blog): View
    {
        $categories = BlogCategory::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.blog.edit', ['post' => $blog, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogPostRequest $request, BlogPost $blog): RedirectResponse
    {
        $data = $request->safe()->except(['cover_image']);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? null, $data['title'], $blog->id);

        if ($data['is_published']) {
            $data['published_at'] = $blog->published_at ?? now();
        } else {
            $data['published_at'] = null;
        }

        if ($request->hasFile('cover_image')) {
            if ($blog->cover_image_path && Storage::disk('public')->exists($blog->cover_image_path)) {
                Storage::disk('public')->delete($blog->cover_image_path);
            }
            $data['cover_image_path'] = $request->file('cover_image')->store('blog', 'public');
        }

        $blog->update($data);

        return redirect()
            ->route('admin.blog.index')
            ->with('status', 'Wellness article updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $blog): RedirectResponse
    {
        if ($blog->cover_image_path && Storage::disk('public')->exists($blog->cover_image_path)) {
            Storage::disk('public')->delete($blog->cover_image_path);
        }

        $blog->delete();

        return redirect()
            ->route('admin.blog.index')
            ->with('status', 'Wellness article deleted.');
    }

    private function uniqueSlug(?string $providedSlug, string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($providedSlug ?: $title) ?: 'article';
        $slug = $base;
        $counter = 2;

        while (
            BlogPost::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$base}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
