<?php

namespace App\Http\Controllers\Public;

use App\Enums\ContentStatus;
use App\Http\Controllers\Controller;
use App\Models\InstructorProfile;
use App\Models\ProgrammeCategory;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        $instructor = InstructorProfile::with('user')->first();

        return view('public.about', compact('instructor'));
    }

    public function expertise(): View
    {
        $categories = ProgrammeCategory::with([
            'programmes' => fn ($query) => $query
                ->where('status', ContentStatus::Published->value)
                ->orderBy('sort_order'),
        ])
            ->orderBy('sort_order')
            ->get();

        return view('public.expertise', compact('categories'));
    }
}
