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

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', [PageController::class, 'home'])->name('home');
Route::get('/bookRoom', [PageController::class, 'bookRoom'])->name('bookRoom');
Route::get('/bookRoom/{roomName}', [PageController::class, 'showRoom'])->name('rooms.show');
Route::get('/discussionForm/{id}', [PageController::class, 'discussionForm'])->name('discussion.show');

Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');