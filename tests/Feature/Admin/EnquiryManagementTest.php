<?php

use App\Models\Enquiry;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;

beforeEach(fn () => $this->seed(RolePermissionSeeder::class));

it('allows authenticated admin to list, filter, inspect, update status, and delete enquiries', function () {
    $admin = User::factory()->create(['is_active' => true]);
    $admin->roles()->attach(Role::where('slug', 'owner')->value('id'));

    $enquiry = Enquiry::create([
        'name' => 'Siddharth Nair',
        'email' => 'siddharth@example.com',
        'phone' => '9829000000',
        'preference' => 'online',
        'message' => 'Looking for evening meditation sessions.',
        'status' => 'new',
    ]);

    $this->actingAs($admin)
        ->get(route('admin.enquiries.index', ['status' => 'new']))
        ->assertOk()
        ->assertSee('Siddharth Nair');

    $this->actingAs($admin)
        ->get(route('admin.enquiries.show', $enquiry))
        ->assertOk()
        ->assertSee('Looking for evening meditation sessions.');

    $this->actingAs($admin)
        ->patch(route('admin.enquiries.update', $enquiry), [
            'status' => 'contacted',
        ])
        ->assertRedirect();

    expect($enquiry->fresh()->status)->toBe('contacted');

    $this->actingAs($admin)
        ->delete(route('admin.enquiries.destroy', $enquiry))
        ->assertRedirect(route('admin.enquiries.index'));

    expect(Enquiry::find($enquiry->id))->toBeNull();
});
