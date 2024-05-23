<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('user', static fn() => request()->user())->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'register'])->middleware('guest');
Route::post('login', [AuthController::class, 'login'])->middleware('guest');
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

