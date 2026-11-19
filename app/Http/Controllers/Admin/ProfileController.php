<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateInstructorProfileRequest;
use App\Models\InstructorProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $profile = InstructorProfile::firstOrCreate(
            ['user_id' => $request->user()->id],
            [
                'title' => 'Yogacharya',
                'short_bio' => 'Certified Yoga Instructor & Holistic Wellness Practitioner.',
                'years_of_experience' => 10,
                'is_published' => true,
            ]
        );

        return view('admin.profile.edit', compact('profile'));
    }

    public function update(UpdateInstructorProfileRequest $request): RedirectResponse
    {
        $profile = InstructorProfile::firstOrCreate(['user_id' => $request->user()->id]);
        $data = $request->safe()->except(['headshot', 'qualifications']);

        // Convert newline-separated qualifications into clean array
        $data['qualifications'] = collect(preg_split('/\r\n|\r|\n/', (string) $request->input('qualifications')))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();

        if ($request->hasFile('headshot')) {
            if ($profile->headshot_path) {
                Storage::disk('public')->delete($profile->headshot_path);
            }
            $data['headshot_path'] = $request->file('headshot')->store('instructor', 'public');
        }

        $profile->update($data);

        return redirect()
            ->route('admin.profile.edit')
            ->with('status', 'Instructor profile updated successfully.');
    }
}
