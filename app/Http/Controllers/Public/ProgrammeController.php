<?php

namespace App\Http\Controllers\Public;

use App\Enums\ContentStatus;
use App\Http\Controllers\Controller;
use App\Models\Programme;
use Illuminate\View\View;

class ProgrammeController extends Controller
{
    public function index(): View
    {
        return view('public.programmes.index');
    }

    public function show(Programme $programme): View
    {
        abort_unless($programme->getAttribute('status') === ContentStatus::Published, 404);

        return view('public.programmes.show', compact('programme'));
    }
}
