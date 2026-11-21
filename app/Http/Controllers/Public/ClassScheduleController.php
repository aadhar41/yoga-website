<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ClassSchedule;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClassScheduleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): View
    {
        $schedules = ClassSchedule::with('programme')
            ->where('is_active', true)
            ->orderBy('start_time')
            ->get();

        return view('public.schedule', compact('schedules'));
    }
}
