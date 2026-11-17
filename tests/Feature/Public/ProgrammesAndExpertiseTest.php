<?php

use App\Enums\ContentStatus;
use App\Models\Programme;
use App\Models\ProgrammeCategory;

it('renders the programmes index page grouped by published categories', function () {
    $category = ProgrammeCategory::factory()->create([
        'name' => 'Hatha & Alignment',
        'status' => ContentStatus::Published,
    ]);
    $programme = Programme::factory()->create([
        'programme_category_id' => $category->id,
        'title' => 'Advanced Hatha Flow',
        'status' => ContentStatus::Published,
    ]);

    $this->get(route('programmes.index'))
        ->assertOk()
        ->assertSee('Hatha & Alignment')
        ->assertSee('Advanced Hatha Flow')
        ->assertSee('not a substitute for medical diagnosis or treatment');
});

it('renders individual published programme detail pages', function () {
    $category = ProgrammeCategory::factory()->create();
    $programme = Programme::factory()->create([
        'programme_category_id' => $category->id,
        'title' => 'Morning Pranayama Series',
        'status' => ContentStatus::Published,
    ]);

    $this->get(route('programmes.show', $programme))
        ->assertOk()
        ->assertSee('Morning Pranayama Series')
        ->assertSee('not a substitute for medical diagnosis or treatment');
});

it('renders the expertise page with all nine disciplines and wellness disclaimer', function () {
    $this->get(route('expertise'))
        ->assertOk()
        ->assertSee('Classical Hatha Yoga')
        ->assertSee('Ashtanga Foundations')
        ->assertSee('Pranayama & Breathwork')
        ->assertSee('Flexibility & Functional Strength')
        ->assertSee('Therapeutic Yoga & Adaptation')
        ->assertSee('Guided Meditation')
        ->assertSee('Mindfulness & Self-Awareness')
        ->assertSee('Stress Management & Recovery')
        ->assertSee('Chakra Balancing & Energetic Focus')
        ->assertSee('not a substitute for medical diagnosis or treatment');
});
