<?php

use Spatie\Sitemap\SitemapGenerator;

it('renders SEO meta tags and JSON-LD schema on home and contact pages', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('rel="canonical"', false)
        ->assertSee('property="og:title"', false)
        ->assertSee('name="twitter:card"', false)
        ->assertSee('application/ld+json', false)
        ->assertSee('Yogacharya Deepashree Gaur');

    $this->get(route('contact'))
        ->assertOk()
        ->assertSee('application/ld+json', false)
        ->assertSee('LocalBusiness');
});

it('exposes robots.txt disallow rules and sitemap reference', function () {
    $content = file_get_contents(public_path('robots.txt'));

    expect($content)
        ->toContain('Disallow: /admin')
        ->toContain('Disallow: /login')
        ->toContain('Disallow: /dashboard')
        ->toContain('Sitemap: https://yogawithdeepashree.com/sitemap.xml');
});

it('can generate sitemap xml via SitemapGenerator', function () {
    $target = storage_path('framework/testing-sitemap.xml');
    if (file_exists($target)) {
        unlink($target);
    }

    SitemapGenerator::create(config('app.url'))->writeToFile($target);

    expect(file_exists($target))->toBeTrue();
    unlink($target);
});
