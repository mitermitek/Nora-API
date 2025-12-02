<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Friends\ShowFriendsAlbumsController;
use App\Http\Controllers\Friends\ShowFriendsPhotosController;
use App\Http\Controllers\Token\CreateTokenController;
use App\Http\Controllers\Token\RevokeCurrentTokenController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', RegisterController::class);
});

Route::prefix('tokens')->group(function () {
    Route::post('', CreateTokenController::class);
    Route::delete('', RevokeCurrentTokenController::class)->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('friends')->group(function () {
        Route::prefix('photos')->group(function () {
            Route::get('', ShowFriendsPhotosController::class);
        });
        Route::prefix('albums')->group(function () {
            Route::get('', ShowFriendsAlbumsController::class);
        });
    });
});
