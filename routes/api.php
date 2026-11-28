<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->name('v1.')->group(function (): void {

    Route::prefix('auth')->name('auth.')->controller(AuthController::class)->group(function (): void {
        Route::post('/send-code', 'sendCode')->name('send-code');
        Route::post('/verify-code', 'verifyCode')->name('verify-code');
        Route::post('/logout', 'logout')->middleware('auth:sanctum')->name('logout');
    });

    Route::middleware('auth:sanctum')->name('profile.')->controller(ProfileController::class)->group(function (): void {
        Route::get('/profile', 'show')->name('show');
        Route::put('/profile', 'update')->name('update');
    });

    Route::get('/genres', [GenreController::class, 'index']);

});
