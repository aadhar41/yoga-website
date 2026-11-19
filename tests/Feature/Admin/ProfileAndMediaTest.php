<?php

use App\Models\Role;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(fn () => $this->seed(RolePermissionSeeder::class));

function ownerUser(): User
{
    $user = User::factory()->create(['is_active' => true]);
    $user->roles()->attach(Role::where('slug', 'owner')->value('id'));

    return $user;
}

it('allows authenticated admin to update instructor profile and upload headshot', function () {
    Storage::fake('public');
    $owner = ownerUser();

    $this->actingAs($owner)
        ->put(route('admin.profile.update'), [
            'title' => 'Yogacharya',
            'tagline' => 'Classical Hatha & Pranayama',
            'short_bio' => 'Certified yoga teacher with 10+ years of experience.',
            'years_of_experience' => 12,
            'qualifications' => "MA in Yogic Science\n200-Hour TTC",
            'headshot' => UploadedFile::fake()->image('portrait.jpg'),
            'is_published' => '1',
        ])
        ->assertRedirect(route('admin.profile.edit'));

    $profile = $owner->instructorProfile()->first();
    expect($profile->years_of_experience)->toBe(12)
        ->and($profile->qualifications)->toBe(['MA in Yogic Science', '200-Hour TTC']);
    Storage::disk('public')->assertExists($profile->headshot_path);
});

it('allows uploading and deleting images in the media library', function () {
    Storage::fake('public');
    $owner = ownerUser();

    $this->actingAs($owner)
        ->post(route('admin.media.store'), [
            'folder' => 'media',
            'file' => UploadedFile::fake()->image('studio.webp'),
        ])
        ->assertRedirect(route('admin.media.index'));

    $uploaded = Storage::disk('public')->allFiles('media')[0];
    Storage::disk('public')->assertExists($uploaded);

    $this->actingAs($owner)
        ->delete(route('admin.media.destroy', $uploaded))
        ->assertRedirect(route('admin.media.index'));

    Storage::disk('public')->assertMissing($uploaded);
});
