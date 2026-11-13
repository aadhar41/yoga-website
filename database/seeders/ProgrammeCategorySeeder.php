<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ProgrammeCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProgrammeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Yoga Classes',
            'Meditation',
            'Therapeutic Yoga',
            'Pranayama',
            'Personalised Wellness',
            'Holistic Wellness',
        ];

        foreach ($categories as $index => $name) {
            ProgrammeCategory::firstOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'sort_order' => $index + 1,
                ]
            );
        }
    }
}
