<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\InstructorProfile;
use App\Models\Programme;
use App\Models\ProgrammeCategory;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $featuredProgrammes = Programme::with('category')
            ->published()
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        $categories = ProgrammeCategory::orderBy('sort_order')->get();

        $instructor = InstructorProfile::with('user')->first();

        $testimonials = (class_exists(Testimonial::class) && Schema::hasTable('testimonials'))
            ? Testimonial::where('is_approved', true)->latest()->take(3)->get()
            : collect();

        $latestPosts = (class_exists(BlogPost::class) && Schema::hasTable('blog_posts'))
            ? BlogPost::where('is_published', true)->latest('published_at')->take(3)->get()
            : collect();

        return view('public.home', compact(
            'featuredProgrammes',
            'categories',
            'instructor',
            'testimonials',
            'latestPosts',
        ));
    }
}
