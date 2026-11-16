<?php

use App\Enums\ContentStatus;
use App\Models\InstructorProfile;
use App\Models\Programme;
use App\Models\ProgrammeCategory;
use App\Models\User;

it('renders the home page with hero CTAs, featured programmes, and wellness disclaimer', function () {
    $category = ProgrammeCategory::factory()->create();
    $featured = Programme::factory()->create([
        'programme_category_id' => $category->id,
        'title' => 'Morning Hatha Foundation',
        'status' => ContentStatus::Published,
        'sort_order' => 1,
    ]);
    $draft = Programme::factory()->create([
        'programme_category_id' => $category->id,
        'title' => 'Unpublished Restorative Practice',
        'status' => ContentStatus::Draft,
    ]);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Explore Programmes')
        ->assertSee('Enquire Now')
        ->assertSee($featured->title)
        ->assertDontSee($draft->title)
        ->assertSee('not a substitute for medical diagnosis or treatment');
});

it('renders the about page with the instructor profile', function () {
    $user = User::factory()->create(['name' => 'Deepashree Gaur']);
    $instructor = InstructorProfile::factory()->for($user)->create();

    $this->get(route('about'))
        ->assertOk()
        ->assertSee($instructor->title.' '.$user->name);
});

it('displays the wellness disclaimer on specialised wellness and programme pages', function () {
    $category = ProgrammeCategory::factory()->create();
    $programme = Programme::factory()->create([
        'programme_category_id' => $category->id,
        'status' => ContentStatus::Published,
    ]);

    $disclaimer = 'not a substitute for medical diagnosis or treatment';

    $this->get(route('expertise'))->assertOk()->assertSee($disclaimer);
    $this->get(route('programmes.index'))->assertOk()->assertSee($disclaimer);
    $this->get(route('programmes.show', $programme))->assertOk()->assertSee($disclaimer);
});

it('hides draft programmes from public routes', function () {
    $programme = Programme::factory()->create([
        'status' => ContentStatus::Draft,
    ]);

    $this->get(route('programmes.show', $programme))
        ->assertNotFound();
});
