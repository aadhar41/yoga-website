<?php

use App\Models\BlogPost;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;

beforeEach(fn () => $this->seed(RolePermissionSeeder::class));

it('allows authenticated admin to publish, update, and view blog posts publicly', function () {
    $admin = User::factory()->create(['is_active' => true]);
    $admin->roles()->attach(Role::where('slug', 'owner')->value('id'));

    $this->actingAs($admin)
        ->post(route('admin.blog.store'), [
            'title' => 'Mindful Morning Breathwork',
            'excerpt' => 'Simple breath awareness to start your day calmly.',
            'body' => 'Sit comfortably with an upright spine and observe natural inhalation and exhalation.',
            'is_published' => '1',
        ])
        ->assertRedirect(route('admin.blog.index'));

    $post = BlogPost::where('title', 'Mindful Morning Breathwork')->firstOrFail();
    expect($post->is_published)->toBeTrue()
        ->and($post->published_at)->not->toBeNull();

    $this->get(route('blog.index'))
        ->assertOk()
        ->assertSee('Mindful Morning Breathwork');

    $this->get(route('blog.show', $post))
        ->assertOk()
        ->assertSee('Mindful Morning Breathwork');
});
