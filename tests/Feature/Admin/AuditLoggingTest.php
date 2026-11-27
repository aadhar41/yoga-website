<?php

use App\Models\AuditLog;
use App\Models\Enquiry;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;

beforeEach(fn () => $this->seed(RolePermissionSeeder::class));

it('records audit logs for enquiry status changes and displays them in the admin audit log', function () {
    $admin = User::factory()->create(['is_active' => true]);
    $admin->roles()->attach(Role::where('slug', 'owner')->value('id'));

    $enquiry = Enquiry::create([
        'name' => 'Aarav Mehta',
        'email' => 'aarav@example.com',
        'phone' => '9829111111',
        'preference' => 'online',
        'message' => 'Morning batch enquiry.',
        'status' => 'new',
    ]);

    $this->actingAs($admin)
        ->patch(route('admin.enquiries.update', $enquiry), [
            'status' => 'contacted',
        ])
        ->assertRedirect();

    $updatedLog = AuditLog::where('action', 'updated')
        ->where('auditable_id', $enquiry->id)
        ->firstOrFail();

    expect($updatedLog->user_id)->toBe($admin->id)
        ->and($updatedLog->metadata['old']['status'] ?? null)->toBe('new')
        ->and($updatedLog->metadata['new']['status'] ?? null)->toBe('contacted');

    $this->actingAs($admin)
        ->get(route('admin.audit-logs.index'))
        ->assertOk()
        ->assertSee('Updated Enquiry: Aarav Mehta');
});
