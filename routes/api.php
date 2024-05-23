<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReviewController;

Route::get('user', static fn() => request()->user())->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'register'])->middleware('guest');
Route::post('login', [AuthController::class, 'login'])->middleware('guest');
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::group([
    'middleware' => 'auth:sanctum',
], static function () {
    Route::post('hotels', [HotelController::class, 'store']);
    Route::get('hotels/{hotel}/rooms', [RoomController::class, 'index']);
    Route::post('hotels/{hotel}/rooms', [RoomController::class, 'store']);
    Route::get('hotels/{hotel}/rooms/{room}/bookings', [BookingController::class, 'index']);
    Route::post('hotels/{hotel}/rooms/{room}/bookings', [BookingController::class, 'store']);
    Route::delete('hotels/{hotel}/rooms/{room}/bookings/{booking}', [BookingController::class, 'cancel']);
});
