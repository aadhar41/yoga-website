<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Roles and Permissions first
        $this->call(RolePermissionSeeder::class);

        // 2. Create or update the Owner account from .env
        $owner = User::updateOrCreate(
            ['email' => env('OWNER_EMAIL', 'admin@yogawithdeepashree.com')],
            [
                'name' => env('OWNER_NAME', 'Yogacharya Deepashree Gaur'),
                'password' => Hash::make(env('OWNER_PASSWORD', 'ChangeMe@123!')),
                'email_verified_at' => now(),
                'is_active' => true,
            ]
        );

        $ownerRoleId = Role::where('slug', 'owner')->value('id');
        if ($ownerRoleId) {
            $owner->roles()->syncWithoutDetaching([$ownerRoleId]);
        }

        // 3. Seed Programme Categories
        $this->call(ProgrammeCategorySeeder::class);

        // 4. Seed Instructor Profile (for Owner) & Sample Programmes
        $this->call(CoreDataSeeder::class);

        // 5. Optional local test user
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'is_active' => true,
            ]
        );
    }
}
