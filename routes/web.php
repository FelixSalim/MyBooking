<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/home', [PageController::class, 'home'])->name('home');
    Route::get('/bookRoom', [PageController::class, 'bookRoom'])->name('bookRoom');
    Route::get('/bookRoom/{roomName}', [PageController::class, 'showRoom'])->name('rooms.show');
    Route::get('/discussionForm/{id}', [PageController::class, 'discussionForm'])->name('discussion.show');

    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

    Route::get('/showClass/{floor}', [PageController::class, 'pick_floor'])->name('class.show');
    Route::get('/classForm/{id}', [PageController::class, 'classForm'])->name('class.form');

    Route::post('/classBookings', [BookingController::class, 'store_class'])->name('class.bookings.store');

    Route::get('/ampitheatreForm', [PageController::class, 'ampitheatreForm'])->name('ampitheatre.form');

    Route::post('/ampitheatreBookings', [BookingController::class, 'store_ampitheatre'])->name('ampitheatre.bookings.store');

    Route::get('/thinktankForm', [PageController::class, 'thinktankForm'])->name('thinktank.form');

    Route::post('/thinktankBookings', [BookingController::class, 'store_thinktank'])->name('thinktank.bookings.store');

    Route::get('/bookShuttle/{selected}', [PageController::class, 'bookShuttle'])->name('bookShuttle');
    Route::get('/shuttleForm/{id}', [PageController::class, 'shuttleForm'])->name('shuttle.form');

    Route::post('/shuttleBookings', [BookingController::class, 'store_shuttle'])->name('shuttle.bookings.store');
});


