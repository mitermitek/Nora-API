<?php

use App\Http\Controllers\Token\CreateTokenController;
use App\Http\Controllers\Token\RevokeCurrentTokenController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('tokens')->group(function () {
    Route::post('', CreateTokenController::class);
    Route::delete('', RevokeCurrentTokenController::class)->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'store']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });
});
