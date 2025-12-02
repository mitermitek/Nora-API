<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Friends\ShowFriendAlbumsController;
use App\Http\Controllers\Friends\ShowFriendController;
use App\Http\Controllers\Friends\ShowFriendPhotosController;
use App\Http\Controllers\Friends\ShowFriendsAlbumsController;
use App\Http\Controllers\Friends\ShowFriendsController;
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
        Route::get('', ShowFriendsController::class);
        Route::get('{id}', ShowFriendController::class);
        Route::get('{id}/photos', ShowFriendPhotosController::class);
        Route::get('{id}/albums', ShowFriendAlbumsController::class);

        Route::prefix('photos')->group(function () {
            Route::get('', ShowFriendsPhotosController::class);
        });
        Route::prefix('albums')->group(function () {
            Route::get('', ShowFriendsAlbumsController::class);
        });
    });
});
