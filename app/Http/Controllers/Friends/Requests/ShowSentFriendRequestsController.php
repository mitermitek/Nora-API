<?php

namespace App\Http\Controllers\Friends\Requests;

use App\Enums\FriendshipStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\FriendRequestResource;
use Illuminate\Http\Request;

class ShowSentFriendRequestsController extends Controller
{
    public function __invoke(Request $request)
    {
        $sentRequests = $request->user()->sentFriendRequests()
            ->with('friend')
            ->where('status', FriendshipStatusEnum::PENDING)
            ->orderByDesc('created_at')
            ->paginate(10);

        return $sentRequests->toResourceCollection(FriendRequestResource::class);
    }
}
