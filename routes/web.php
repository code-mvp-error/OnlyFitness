<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\TrainerController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Response;

Route::get('/robots.txt', function () {
    return Response::make("User-agent: *\nAllow: /\nDisallow: /admin\nDisallow: /member\nDisallow: /dashboard\n\nSitemap: " . url('sitemap.xml') . "\n", 200, ['Content-Type' => 'text/plain']);
})->name('robots');

Route::get('/sitemap.xml', function () {
    $urls = [
        ['loc' => url('/'), 'priority' => '1.0'],
        ['loc' => url('/programs'), 'priority' => '0.9'],
        ['loc' => url('/trainers'), 'priority' => '0.8'],
        ['loc' => url('/pricing'), 'priority' => '0.8'],
        ['loc' => url('/contact'), 'priority' => '0.7'],
    ];

    return Response::view('sitemap', ['urls' => $urls], 200, ['Content-Type' => 'application/xml']);
})->name('sitemap');

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/programs', [ProgramController::class, 'index'])->name('programs');
Route::post('/programs/book', [BookingController::class, 'store'])->name('programs.book');
Route::get('/trainers', [TrainerController::class, 'index'])->name('trainers');
Route::get('/pricing', [PlanController::class, 'index'])->name('pricing');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [MemberController::class, 'dashboard'])->name('dashboard');

    Route::prefix('member')->name('member.')->group(function () {
        Route::get('/bookings', [MemberController::class, 'bookings'])->name('bookings');
        Route::get('/progress', [MemberController::class, 'progress'])->name('progress');
        Route::post('/progress', [MemberController::class, 'storeProgress'])->name('progress.store');
        Route::get('/profile', [MemberController::class, 'profile'])->name('profile');
        Route::put('/profile', [MemberController::class, 'updateProfile'])->name('profile.update');
        Route::put('/password', [MemberController::class, 'updatePassword'])->name('password.update');
        Route::delete('/cancel', [MemberController::class, 'cancelMembership'])->name('cancel');
    });
});

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/members', [AdminController::class, 'members'])->name('members');
    Route::post('/members', [AdminController::class, 'membersStore'])->name('members.store');
    Route::put('/members/{id}', [AdminController::class, 'membersUpdate'])->name('members.update');
    Route::delete('/members/{id}', [AdminController::class, 'membersDestroy'])->name('members.destroy');

    Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');
    Route::post('/bookings', [AdminController::class, 'bookingsStore'])->name('bookings.store');
    Route::put('/bookings/{id}/confirm', [AdminController::class, 'bookingsConfirm'])->name('bookings.confirm');
    Route::put('/bookings/{id}/cancel', [AdminController::class, 'bookingsCancel'])->name('bookings.cancel');
    Route::put('/bookings/{id}/reschedule', [AdminController::class, 'bookingsReschedule'])->name('bookings.reschedule');
    Route::delete('/bookings/{id}', [AdminController::class, 'bookingsDestroy'])->name('bookings.destroy');

    Route::get('/trainers', [AdminController::class, 'trainers'])->name('trainers');
    Route::post('/trainers', [AdminController::class, 'trainersStore'])->name('trainers.store');
    Route::put('/trainers/{id}', [AdminController::class, 'trainersUpdate'])->name('trainers.update');
    Route::delete('/trainers/{id}', [AdminController::class, 'trainersDestroy'])->name('trainers.destroy');

    Route::get('/contacts', [AdminController::class, 'contacts'])->name('contacts');
    Route::put('/contacts/{id}/read', [AdminController::class, 'contactsMarkRead'])->name('contacts.read');
    Route::post('/contacts/{id}/reply', [AdminController::class, 'contactsReply'])->name('contacts.reply');
    Route::put('/contacts/{id}/archive', [AdminController::class, 'contactsArchive'])->name('contacts.archive');
    Route::delete('/contacts/{id}', [AdminController::class, 'contactsDestroy'])->name('contacts.destroy');
});

require __DIR__ . '/auth.php';
