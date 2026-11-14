<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreStaffRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    public function index(): View
    {
        return view('admin.staff.index');
    }

    public function create(): View
    {
        return view('admin.staff.create');
    }

    public function store(StoreStaffRequest $request): RedirectResponse
    {
        $staffRole = Role::query()->where('slug', 'staff')->firstOrFail();
        $validated = $request->safe()->only(['name', 'email', 'password']);

        DB::transaction(function () use ($validated, $staffRole): void {
            $user = User::create($validated);
            $user->assignRole($staffRole);
        });

        return to_route('admin.staff.index')->with('status', 'Staff member created.');
    }
}
