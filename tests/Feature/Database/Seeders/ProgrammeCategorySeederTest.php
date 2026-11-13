<?php

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the database seeder creates the six initial programme categories once', function () {
    $this->seed(DatabaseSeeder::class);
    $this->seed(DatabaseSeeder::class);

    $this->assertDatabaseCount('programme_categories', 6);

    foreach ([
        'Yoga Classes' => 'yoga-classes',
        'Meditation' => 'meditation',
        'Therapeutic Yoga' => 'therapeutic-yoga',
        'Pranayama' => 'pranayama',
        'Personalised Wellness' => 'personalised-wellness',
        'Holistic Wellness' => 'holistic-wellness',
    ] as $name => $slug) {
        $this->assertDatabaseHas('programme_categories', [
            'name' => $name,
            'slug' => $slug,
        ]);
    }
});
