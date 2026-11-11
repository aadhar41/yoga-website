<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // $this->call(RbacSeeder::class);

        $this->call(RolePermissionSeeder::class);

        $owner = User::updateOrCreate(
            ['email' => env('OWNER_EMAIL')],
            ['name' => env('OWNER_NAME'), 'password' => Hash::make(env('OWNER_PASSWORD')),
            'email_verified_at' => now(), 'is_active' => true]
        );
        $owner->roles()->syncWithoutDetaching([Role::where('slug', 'owner')->value('id')]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
