<?php

use App\Models\Programme;
use App\Models\ProgrammeCategory;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;

beforeEach(fn () => $this->seed(RolePermissionSeeder::class));

function adminUser(): User
{
    $user = User::factory()->create(['is_active' => true]);
    $user->roles()->attach(Role::where('slug', 'owner')->value('id'));

    return $user;
}

it('allows authenticated admin to create, update, and delete a programme', function () {
    $admin = adminUser();
    $category = ProgrammeCategory::factory()->create();

    $this->actingAs($admin)
        ->post(route('admin.programmes.store'), [
            'programme_category_id' => $category->id,
            'title' => 'Restorative Breath & Yoga',
            'short_description' => 'Gentle breathwork and alignment.',
            'level' => 'Beginner',
            'duration_text' => '60 mins / session',
            'sort_order' => 1,
            'is_published' => '1',
        ])
        ->assertRedirect(route('admin.programmes.index'));

    $programme = Programme::where('title', 'Restorative Breath & Yoga')->firstOrFail();
    expect($programme->is_published)->toBeTrue();

    $this->actingAs($admin)
        ->put(route('admin.programmes.update', $programme), [
            'programme_category_id' => $category->id,
            'title' => 'Restorative Breath & Yoga Updated',
            'short_description' => 'Updated summary.',
            'level' => 'All Levels',
            'duration_text' => '75 mins / session',
            'sort_order' => 2,
            'is_published' => '1',
        ])
        ->assertRedirect(route('admin.programmes.index'));

    expect($programme->fresh()->title)->toBe('Restorative Breath & Yoga Updated');

    $this->actingAs($admin)
        ->delete(route('admin.programmes.destroy', $programme))
        ->assertRedirect(route('admin.programmes.index'));

    expect(Programme::find($programme->id))->toBeNull();
});
