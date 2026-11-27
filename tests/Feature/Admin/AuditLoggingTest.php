<?php

use App\Models\AuditLog;
use App\Models\BlogPost;
use App\Models\Enquiry;
use App\Models\Programme;
use App\Models\Role;
use App\Models\Testimonial;
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

it('audits created, updated, and deleted events for configured models', function () {
    $admin = User::factory()->create(['is_active' => true]);
    $admin->roles()->attach(Role::where('slug', 'owner')->value('id'));
    $this->actingAs($admin);

    $staffUser = User::factory()->create(['name' => 'Audited Staff']);
    $programme = Programme::factory()->create();
    $blogPost = BlogPost::create([
        'title' => 'Audited Article',
        'slug' => 'audited-article',
        'body' => 'Article body for the audit test.',
    ]);
    $testimonial = Testimonial::create([
        'author_name' => 'Audited Author',
        'content' => 'A sample testimonial for audit logging.',
    ]);
    $role = Role::create([
        'name' => 'Audited Role',
        'slug' => 'audited-role',
    ]);

    foreach ([$staffUser, $programme, $blogPost, $testimonial, $role] as $model) {
        $this->assertDatabaseHas('audit_logs', [
            'action' => 'created',
            'auditable_type' => $model->getMorphClass(),
            'auditable_id' => $model->getKey(),
            'user_id' => $admin->id,
        ]);
    }

    $createdUserLog = AuditLog::query()
        ->where('action', 'created')
        ->where('auditable_type', $staffUser->getMorphClass())
        ->where('auditable_id', $staffUser->id)
        ->firstOrFail();

    expect($createdUserLog->metadata['attributes']['password'])->toBe('[redacted]');

    $programme->update(['title' => 'Updated Audited Programme']);
    $programme->delete();

    $this->assertDatabaseHas('audit_logs', [
        'action' => 'updated',
        'auditable_type' => $programme->getMorphClass(),
        'auditable_id' => $programme->getKey(),
        'summary' => 'Updated Programme: Updated Audited Programme',
    ]);
    $this->assertDatabaseHas('audit_logs', [
        'action' => 'deleted',
        'auditable_type' => $programme->getMorphClass(),
        'auditable_id' => $programme->getKey(),
    ]);
});
