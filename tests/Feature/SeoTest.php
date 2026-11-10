<?php

test('homepage renders canonical social and structured data metadata', function () {
    config([
        'app.name' => 'Test Site',
        'app.url' => 'https://example.test',
    ]);

    $response = $this->get(route('home'));

    $response->assertOk()
        ->assertSee('<title>Let&#039;s get started - Test Site</title>', false)
        ->assertSee('<link rel="canonical" href="https://example.test/">', false)
        ->assertSee('<meta name="description" content="Get started with Laravel and explore its ecosystem.">', false)
        ->assertSee('<meta property="og:title" content="Let&#039;s get started - Test Site">', false)
        ->assertSee('<meta property="og:url" content="https://example.test/">', false)
        ->assertSee('<meta name="twitter:card" content="summary">', false)
        ->assertSee('application/ld+json', false)
        ->assertSee('https://schema.org', false);
});

test('sitemap contains only the public homepage using the configured base URL', function () {
    config(['app.url' => 'https://example.test']);

    $response = $this->get(route('sitemap'));

    $response->assertOk()
        ->assertHeader('Content-Type', 'application/xml; charset=UTF-8')
        ->assertSee('<loc>https://example.test/</loc>', false)
        ->assertDontSee('/dashboard')
        ->assertDontSee('/settings');
});

test('robots file points to the configured sitemap and excludes non-indexable routes', function () {
    config(['app.url' => 'https://example.test']);

    $response = $this->get(route('robots'));

    $response->assertOk()
        ->assertHeader('Content-Type', 'text/plain; charset=UTF-8')
        ->assertSee('Sitemap: https://example.test/sitemap.xml', false)
        ->assertSee('Disallow: /dashboard', false)
        ->assertSee('Disallow: /settings', false)
        ->assertSee('Disallow: /.well-known/passkey-endpoints', false);
});
