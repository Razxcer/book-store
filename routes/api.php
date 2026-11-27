<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->name('v1.')->group(function (): void {

    Route::prefix('auth')->name('auth.')->group(function (): void {
        Route::post('/send-code', [AuthController::class, 'sendCode']);
        Route::post('/verify-code', [AuthController::class, 'verifyCode']);
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    });

});
