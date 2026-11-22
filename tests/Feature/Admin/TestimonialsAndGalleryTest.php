<?php

use App\Models\GalleryItem;
use App\Models\Role;
use App\Models\Testimonial;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(fn () => $this->seed(RolePermissionSeeder::class));

function tgAdminUser(): User
{
    $user = User::factory()->create(['is_active' => true]);
    $user->roles()->attach(Role::where('slug', 'owner')->value('id'));

    return $user;
}

it('allows authenticated admin to manage testimonials and shows approved ones publicly', function () {
    $admin = tgAdminUser();

    $this->actingAs($admin)
        ->post(route('admin.testimonials.store'), [
            'author_name' => 'Ananya Sharma',
            'author_role' => 'Morning Hatha Batch',
            'content' => 'Calming guidance and clear posture alignment.',
            'rating' => 5,
            'is_approved' => '1',
            'is_featured' => '1',
            'sort_order' => 1,
        ])
        ->assertRedirect(route('admin.testimonials.index'));

    $testimonial = Testimonial::where('author_name', 'Ananya Sharma')->firstOrFail();
    expect($testimonial->is_approved)->toBeTrue();

    $this->get(route('testimonials'))
        ->assertOk()
        ->assertSee('Ananya Sharma');
});

it('allows authenticated admin to upload and delete gallery items', function () {
    Storage::fake('public');
    $admin = tgAdminUser();

    $this->actingAs($admin)
        ->post(route('admin.gallery.store'), [
            'title' => 'Sunrise Asana Session',
            'category' => 'Outdoors',
            'caption' => 'Morning practice in fresh air.',
            'image' => UploadedFile::fake()->image('sunrise.jpg'),
            'is_published' => '1',
            'sort_order' => 1,
        ])
        ->assertRedirect(route('admin.gallery.index'));

    $item = GalleryItem::where('title', 'Sunrise Asana Session')->firstOrFail();
    Storage::disk('public')->assertExists($item->image_path);

    $this->get(route('gallery'))
        ->assertOk()
        ->assertSee('Sunrise Asana Session');

    $this->actingAs($admin)
        ->delete(route('admin.gallery.destroy', $item))
        ->assertRedirect(route('admin.gallery.index'));

    Storage::disk('public')->assertMissing($item->image_path);
});
