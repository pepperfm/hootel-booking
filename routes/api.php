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
    'prefix' => 'hotels',
], static function () {
    Route::post('/', [HotelController::class, 'store']);

    Route::get('{hotel}/rooms', [RoomController::class, 'index']);
    Route::post('{hotel}/rooms', [RoomController::class, 'store']);

    Route::get('{hotel}/rooms/{room}/bookings', [BookingController::class, 'index']);
    Route::post('{hotel}/rooms/{room}/bookings', [BookingController::class, 'store']);
    Route::delete('{hotel}/rooms/{room}/bookings/{booking}', [BookingController::class, 'cancel']);

    Route::post('{hotel}/reviews', [ReviewController::class, 'store']);
    Route::put('{hotel}/reviews/{review}', [ReviewController::class, 'update']);
    Route::delete('{hotel}/reviews/{review}', [ReviewController::class, 'destroy']);
});
