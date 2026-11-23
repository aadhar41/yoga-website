<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    //
    public function index(Request $request): View
    {
        $categorySlug = $request->string('category')->toString();

        $posts = BlogPost::with('category')
            ->published()
            ->when($categorySlug !== '', function ($query) use ($categorySlug) {
                $query->whereHas('category', fn ($q) => $q->where('slug', $categorySlug));
            })
            ->latest('published_at')
            ->latest('id')
            ->paginate(9)
            ->withQueryString();

        $categories = BlogCategory::orderBy('sort_order')->orderBy('name')->get();

        return view('public.blog.index', compact('posts', 'categories', 'categorySlug'));
    }

    public function show(BlogPost $post): View
    {
        abort_unless(
            $post->is_published && ($post->published_at === null || $post->published_at->lte(now())),
            404
        );

        $post->load(['category', 'author']);

        return view('public.blog.show', compact('post'));
    }
}
