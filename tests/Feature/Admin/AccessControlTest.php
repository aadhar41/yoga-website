<?php

use App\Models\Role;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;

beforeEach(fn () => $this->seed(RolePermissionSeeder::class));

function makeUser(string $role, bool $active = true): User
{
    $u = User::factory()->create(['is_active' => $active]);
    $u->roles()->attach(Role::where('slug', $role)->value('id'));

    return $u;
}

it('redirects guests from admin', fn () => $this->get('/admin')->assertRedirect('/login'));

it('lets staff reach the dashboard but not staff management', function () {
    $staff = makeUser('staff');
    $this->actingAs($staff)->get('/admin')->assertOk();
    $this->actingAs($staff)->get('/admin/staff')->assertForbidden();
});

it('lets the owner manage staff', fn () => $this->actingAs(makeUser('owner'))->get('/admin/staff')->assertOk());

it('logs out disabled users immediately', function () {
    $staff = makeUser('staff', active: false);
    $this->actingAs($staff)->get('/admin')->assertRedirect('/login');
});

it('never creates an owner through the staff form', function () {
    $this->actingAs(makeUser('owner'))->post('/admin/staff', [
        'name' => 'Test',
        'email' => 't@example.com',
        'password' => 'StrongPass123',
    ]);

    expect(User::where('email', 't@example.com')->first()->isOwner())->toBeFalse();
});
