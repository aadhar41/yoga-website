<?php

use App\Http\Controllers\Public\BlogController;
use App\Http\Controllers\Public\BookingController;
use App\Http\Controllers\Public\ClassScheduleController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\PageController;
use App\Http\Controllers\Public\ProgrammeController;
use App\Models\GalleryItem;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/expertise', [PageController::class, 'expertise'])->name('expertise');
Route::get('/programmes', [ProgrammeController::class, 'index'])->name('programmes.index');
Route::get('/programmes/{programme:slug}', [ProgrammeController::class, 'show'])->name('programmes.show');
Route::get('/schedule', ClassScheduleController::class)->name('schedule');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::view('/contact', 'public.contact')->name('contact');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');

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

Route::get('/testimonials', function () {
    $testimonials = Testimonial::where('is_approved', true)
        ->orderBy('sort_order')
        ->latest('id')
        ->get();

    return view('public.testimonials', compact('testimonials'));
})->name('testimonials');

Route::get('/gallery', function () {
    $items = GalleryItem::where('is_published', true)
        ->orderBy('sort_order')
        ->latest('id')
        ->get();

    return view('public.gallery', compact('items'));
})->name('gallery');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'active'])->group(function () {

    require __DIR__.'/admin.php';
});

require __DIR__.'/settings.php';
