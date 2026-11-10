<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::get('/sitemap.xml', function () {
    $baseUrl = rtrim((string) config('app.url'), '/');

    return response()
        ->view('seo.sitemap', ['homeUrl' => $baseUrl.'/'])
        ->header('Content-Type', 'application/xml; charset=UTF-8');
})->name('sitemap');

Route::get('/robots.txt', function () {
    $baseUrl = rtrim((string) config('app.url'), '/');
    $content = implode("\n", [
        'User-agent: *',
        'Allow: /',
        'Disallow: /dashboard',
        'Disallow: /settings',
        'Disallow: /up',
        'Disallow: /.well-known/passkey-endpoints',
        '',
        'Sitemap: '.$baseUrl.'/sitemap.xml',
        '',
    ]);

    return response($content)->header('Content-Type', 'text/plain; charset=UTF-8');
})->name('robots');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
