<?php

use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckTokenExpiration;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;


Route::get('/users', [UserController::class, 'index'])->name('users-page');
Route::get('/users/create', [UserController::class, 'create']);
Route::get('/users/{user}', [UserController::class, 'show']);

Route::post('/users', [UserController::class, 'store'])->middleware([CheckTokenExpiration::class]);

Route::get('/token', [UserController::class, 'generateToken']);

Route::get('/positions', [PositionController::class, 'index']);

