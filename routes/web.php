<?php

use App\Http\Controllers\AuthController\LoginController;
use App\Http\Controllers\UserDashboardController\UserDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/', [UserDashboardController::class, 'index']);
    Route::post('/presences/in', [UserDashboardController::class, 'presenceIn']);
    Route::post('/presences/out', [UserDashboardController::class, 'presenceOut']);
    
    Route::post('/logout', [LoginController::class, 'logout']);

    Route::get('/profile', [UserDashboardController::class, 'profile']);

    Route::post('/update/password', [UserDashboardController::class, 'updatePassword']);
    Route::post('/update/profile', [UserDashboardController::class, 'updateProfile']);
});