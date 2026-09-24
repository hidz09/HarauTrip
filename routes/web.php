<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\TourPackageController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OperatorController;


/*
|--------------------------------------------------------------------------
| LANDING PAGE
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingController::class, 'index'])->name('home');

Route::get('/about', [LandingController::class, 'about'])
    ->name('landing.about');

Route::get('/contact', [LandingController::class, 'contact'])
    ->name('landing.contact');

Route::post('/contact', [LandingController::class, 'sendContact'])
    ->name('landing.contact.send');

Route::get('/destinasi', [LandingController::class, 'destinations'])
    ->name('landing.destinations');


/*
|--------------------------------------------------------------------------
| USER PACKAGE (hanya bisa diakses setelah login)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/packages', [LandingController::class, 'packages'])
        ->name('landing.packages');

});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| USER DASHBOARD (riwayat booking & pembayaran milik sendiri)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| BOOKING - CHECKOUT USER (halaman standalone, dipakai dari landing page)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/checkout', [BookingController::class, 'create'])
        ->name('booking.create');

    Route::post('/checkout', [BookingController::class, 'store'])
        ->name('booking.store');

});

/*
|--------------------------------------------------------------------------
| ADMIN PACKAGE
|--------------------------------------------------------------------------
*/

Route::get('/package', [TourPackageController::class, 'index'])
    ->name('admin.package.index');

Route::get('/package/create', [TourPackageController::class, 'create'])
    ->name('admin.package.create');

Route::post('/package/create', [TourPackageController::class, 'store'])
    ->name('admin.package.store');

Route::get('/package/edit/{id}', [TourPackageController::class, 'edit'])
    ->name('admin.package.edit');

Route::put('/package/edit/{id}', [TourPackageController::class, 'update'])
    ->name('admin.package.update');

Route::delete('/package/delete/{id}', [TourPackageController::class, 'destroy'])
    ->name('admin.package.delete');

/*
|--------------------------------------------------------------------------
| ADMIN DESTINATION
|--------------------------------------------------------------------------
*/

Route::get('/destination', [DestinationController::class, 'index'])
    ->name('admin.destination.index');

Route::get('/destination/create', [DestinationController::class, 'create'])
    ->name('admin.destination.create');

Route::get('/destinasi/{destination}', [DestinationController::class, 'show'])
    ->name('destinations.show');

Route::post('/destination/create', [DestinationController::class, 'store'])
    ->name('admin.destination.store');

Route::get('/destination/edit/{destination}', [DestinationController::class, 'edit'])
    ->name('admin.destination.edit');

Route::put('/destination/edit/{destination}', [DestinationController::class, 'update'])
    ->name('admin.destination.update');

Route::delete('/destination/delete/{destination}', [DestinationController::class, 'destroy'])
    ->name('admin.destination.delete');

/*
|--------------------------------------------------------------------------
| ADMIN BOOKING
|--------------------------------------------------------------------------
*/

Route::get('/booking', [BookingController::class, 'index'])
    ->name('admin.booking.index');

Route::get('/booking/create', [BookingController::class, 'createAdmin'])
    ->name('admin.booking.create');

Route::post('/booking/create', [BookingController::class, 'storeAdmin'])
    ->name('admin.booking.store');

Route::get('/booking/{booking}', [BookingController::class, 'show'])
    ->name('admin.booking.show');

Route::get('/booking/edit/{booking}', [BookingController::class, 'edit'])
    ->name('admin.booking.edit');

Route::put('/booking/edit/{booking}', [BookingController::class, 'update'])
    ->name('admin.booking.update');

Route::delete('/booking/delete/{booking}', [BookingController::class, 'destroy'])
    ->name('admin.booking.delete');

/*
|--------------------------------------------------------------------------
| PAYMENT (user-facing: bayar via Midtrans Snap untuk sebuah booking)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/payment/{booking}/create', [PaymentController::class, 'create'])
        ->name('payment.create');

    Route::get('/payment/{booking}/status', [PaymentController::class, 'status'])
        ->name('payment.status');

    Route::post('/payment', [PaymentController::class, 'store'])
        ->name('payment.store');

    Route::get('/payment/{booking}/finish', [PaymentController::class, 'finish'])
        ->name('payment.finish');

});

// Webhook dari server Midtrans — TIDAK boleh pakai middleware auth/CSRF,
// karena dipanggil langsung oleh server Midtrans, bukan oleh user.
Route::post('/payment/callback', [PaymentController::class, 'callback'])
    ->name('payment.callback');

/*
|--------------------------------------------------------------------------
| ADMIN PAYMENT (kelola & verifikasi pembayaran)
|--------------------------------------------------------------------------
*/

Route::get('/admin/payment', [PaymentController::class, 'index'])
    ->name('admin.payment.index');

Route::get('/admin/payment/{payment}', [PaymentController::class, 'show'])
    ->name('admin.payment.show');

Route::put('/admin/payment/{payment}', [PaymentController::class, 'update'])
    ->name('admin.payment.update');


/*
|--------------------------------------------------------------------------
| OPERATOR - SCAN VOUCHER, JADWAL HARI INI, RIWAYAT CHECK-IN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:operator,admin'])->prefix('operator')->group(function () {

    Route::get('/today', [OperatorController::class, 'today'])
        ->name('operator.today');

    Route::get('/scan', [OperatorController::class, 'scan'])
        ->name('operator.scan');

    Route::post('/verify', [OperatorController::class, 'verify'])
        ->name('operator.verify');

        Route::post('/operator/check-in', [OperatorController::class, 'checkIn'])
    ->name('operator.checkin');

    Route::get('/history', [OperatorController::class, 'history'])
        ->name('operator.history');

});

/*
|--------------------------------------------------------------------------
| ADMIN REPORT
|--------------------------------------------------------------------------
*/

Route::get('/report', [ReportController::class, 'index'])
    ->name('admin.report.index');