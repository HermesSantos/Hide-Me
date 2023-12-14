<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserEventController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// authentication routes
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

/***********/
Route::middleware('jwt.auth')->group(function () {
    Route::post('get-user-events', [UserEventController::class, 'getUserEvents']);
    Route::post('create-user-event', [UserEventController::class, 'createEvent']);
});
