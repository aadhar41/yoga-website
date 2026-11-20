<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

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

        $ownerName = config('app.owner.name');
        $ownerEmail = config('app.owner.email');
        $ownerPassword = config('app.owner.password');

        if (! is_string($ownerName) || ! is_string($ownerEmail) || ! is_string($ownerPassword)) {
            throw new InvalidArgumentException('Owner seed configuration values must be strings.');
        }

        // 2. Create or update the Owner account
        $owner = User::updateOrCreate(
            ['email' => $ownerEmail],
            [
                'name' => $ownerName,
                'password' => Hash::make($ownerPassword),
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
