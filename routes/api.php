<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Friends\Friend\ShowFriendAlbumsController;
use App\Http\Controllers\Friends\Friend\ShowFriendController;
use App\Http\Controllers\Friends\Friend\ShowFriendPhotosController;
use App\Http\Controllers\Friends\Requests\AcceptFriendRequestController;
use App\Http\Controllers\Friends\Requests\CreateFriendRequestController;
use App\Http\Controllers\Friends\Requests\DeclineFriendRequestController;
use App\Http\Controllers\Friends\Requests\ShowReceivedFriendRequestsController;
use App\Http\Controllers\Friends\Requests\ShowSentFriendRequestsController;
use App\Http\Controllers\Friends\ShowFriendsAlbumsController;
use App\Http\Controllers\Friends\ShowFriendsController;
use App\Http\Controllers\Friends\ShowFriendsPhotosController;
use App\Http\Controllers\Tokens\CreateTokenController;
use App\Http\Controllers\Tokens\RevokeCurrentTokenController;
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

        Route::prefix('requests')->group(function () {
            Route::prefix('sent')->group(function () {
                Route::get('', ShowSentFriendRequestsController::class);
                Route::post('', CreateFriendRequestController::class);
            });

            Route::prefix('received')->group(function () {
                Route::get('', ShowReceivedFriendRequestsController::class);
                Route::patch('{id}/accept', AcceptFriendRequestController::class);
                Route::patch('{id}/decline', DeclineFriendRequestController::class);
            });
        });

        Route::prefix('photos')->group(function () {
            Route::get('', ShowFriendsPhotosController::class);
        });
        Route::prefix('albums')->group(function () {
            Route::get('', ShowFriendsAlbumsController::class);
        });
    });
});
