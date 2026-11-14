<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StaffController;
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

Route::prefix('admin')->name('admin.')->middleware(['auth', 'active'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::prefix('staff')->name('staff.')->middleware('can:manage-staff')->group(function () {
        Route::get('/', [StaffController::class, 'index'])->name('index');
        Route::get('/create', [StaffController::class, 'create'])->name('create');
        Route::post('/', [StaffController::class, 'store'])->name('store');
    });
});

require __DIR__.'/settings.php';
