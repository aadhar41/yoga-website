<?php

use App\Enums\ContentStatus;
use App\Models\Enquiry;
use App\Models\Programme;
use App\Models\ProgrammeCategory;
use Illuminate\Support\Facades\Validator;

beforeEach(function () {
    Validator::fakeDnsLookups();
});

afterEach(function () {
    Validator::fakeDnsLookups(false);
});

it('renders the contact enquiry page and persists a valid enquiry', function () {
    $category = ProgrammeCategory::factory()->create();
    $programme = Programme::factory()->create([
        'programme_category_id' => $category->id,
        'status' => ContentStatus::Published,
    ]);

    $this->get(route('contact'))
        ->assertOk()
        ->assertSee($programme->title);

    $this->post(route('contact.store'), [
        'programme_id' => $programme->id,
        'name' => 'Riya Verma',
        'email' => 'riya@example.com',
        'phone' => '9876543210',
        'preference' => 'online',
        'preferred_date' => now()->addDay()->toDateString(),
        'preferred_time' => '07:00 AM',
        'message' => 'Looking for morning yoga guidance.',
    ])->assertRedirect(route('contact'))
        ->assertSessionHasNoErrors();

    $enquiry = Enquiry::where('email', 'riya@example.com')->firstOrFail();
    expect($enquiry->name)->toBe('Riya Verma')
        ->and($enquiry->status)->toBe('new')
        ->and($enquiry->programme_id)->toBe($programme->id);
});

it('rejects empty messages and honeypot submissions', function () {
    $this->post(route('contact.store'), [
        'website' => 'https://spam.example.com',
        'name' => 'Bot User',
        'email' => 'bot@example.com',
        'phone' => '9999999999',
        'preference' => 'online',
        'message' => 'Spam message',
    ])->assertSessionHasErrors('website');

    $this->post(route('contact.store'), [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'phone' => '9999999999',
        'preference' => 'online',
        'message' => '',
    ])->assertSessionHasErrors('message');
});
