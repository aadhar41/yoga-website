<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'manage-staff' => 'Create, edit and disable staff',
            'manage-roles' => 'Configure roles and permissions',
            'manage-profile' => 'Edit instructor profile',
            'manage-programmes' => 'Programme CRUD and categories',
            'manage-classes' => 'Classes, schedules and venues',
            'manage-enquiries' => 'View and handle enquiries',
            'manage-testimonials' => 'Testimonials',
            'manage-gallery' => 'Gallery and media',
            'manage-blog' => 'Blog posts and categories',
            'manage-settings' => 'Website settings, contact info and SEO',
            'view-activity-log' => 'View the activity log',
        ];

        foreach ($permissions as $slug => $desc) {
            Permission::updateOrCreate(['slug' => $slug], ['name' => str($slug)->replace('-', ' ')->title(), 'description' => $desc]);
        }

        $owner = Role::updateOrCreate(['slug' => 'owner'], ['name' => 'Owner / Super Admin']);
        $owner->permissions()->sync(Permission::pluck('id'));

        $staff = Role::updateOrCreate(['slug' => 'staff'], ['name' => 'Staff']);
        $staff->permissions()->sync(Permission::whereIn('slug', [
            'manage-enquiries', 'manage-programmes', 'manage-classes',
            'manage-testimonials', 'manage-gallery', 'manage-blog',
        ])->pluck('id'));
    }
}
