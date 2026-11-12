<?php

use App\Models\Programme;
use App\Models\ProgrammeCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('deleted programmes are excluded from normal queries but remain in the database', function () {
    $category = ProgrammeCategory::create([
        'name' => 'Yoga Classes',
        'slug' => 'yoga-classes',
    ]);

    $programme = Programme::create([
        'programme_category_id' => $category->id,
        'title' => 'Foundational Yoga',
        'slug' => 'foundational-yoga',
    ]);

    $programme->delete();

    $this->assertSoftDeleted($programme);
    expect(Programme::find($programme->id))->toBeNull();
});
