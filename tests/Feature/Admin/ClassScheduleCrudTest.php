<?php

use App\Models\ClassSchedule;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;

beforeEach(fn () => $this->seed(RolePermissionSeeder::class));

function scheduleAdminUser(): User
{
    $user = User::factory()->create(['is_active' => true]);
    $user->roles()->attach(Role::where('slug', 'owner')->value('id'));

    return $user;
}

it('allows authenticated admin to create, update, and delete a class schedule and venue', function () {
    $admin = scheduleAdminUser();

    $this->actingAs($admin)
        ->post(route('admin.schedules.store'), [
            'title' => 'Evening Pranayama & Meditation',
            'days_of_week' => 'Mon – Fri',
            'start_time' => '06:00 PM',
            'end_time' => '07:00 PM',
            'mode' => 'offline',
            'venue_name' => 'Harmony Shala',
            'venue_address' => 'Jaipur, Rajasthan',
            'is_active' => '1',
        ])
        ->assertRedirect(route('admin.schedules.index'));

    $schedule = ClassSchedule::where('title', 'Evening Pranayama & Meditation')->firstOrFail();
    expect($schedule->venue_name)->toBe('Harmony Shala')
        ->and($schedule->is_active)->toBeTrue();

    $this->actingAs($admin)
        ->put(route('admin.schedules.update', $schedule), [
            'title' => 'Evening Pranayama & Meditation',
            'days_of_week' => 'Mon – Sat',
            'start_time' => '06:15 PM',
            'end_time' => '07:15 PM',
            'mode' => 'hybrid',
            'venue_name' => 'Harmony Shala',
            'venue_address' => 'Jaipur, Rajasthan',
            'is_active' => '1',
        ])
        ->assertRedirect(route('admin.schedules.index'));

    expect($schedule->fresh()->mode)->toBe('hybrid');

    $this->actingAs($admin)
        ->delete(route('admin.schedules.destroy', $schedule))
        ->assertRedirect(route('admin.schedules.index'));

    expect(ClassSchedule::find($schedule->id))->toBeNull();
});
