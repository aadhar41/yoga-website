<?php

namespace App\Http\Controllers\Public;

use App\Enums\ContentStatus;
use App\Http\Controllers\Controller;
use App\Models\Programme;
use App\Models\ProgrammeCategory;
use Illuminate\View\View;

class ProgrammeController extends Controller
{
    public function index(): View
    {
        $categories = ProgrammeCategory::where('status', ContentStatus::Published->value)
            ->with(['programmes' => fn ($query) => $query->published()->orderBy('sort_order')])
            ->orderBy('sort_order')
            ->get();

        return view('public.programmes.index', compact('categories'));
    }

    public function show(Programme $programme): View
    {
        abort_unless($programme->status === ContentStatus::Published, 404);

        $programme->load('category');

        return view('public.programmes.show', compact('programme'));
    }
}
