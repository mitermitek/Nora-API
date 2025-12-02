<?php

namespace App\Http\Controllers\Friends\Requests;

use App\Enums\FriendshipStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\FriendRequestResource;
use Illuminate\Http\Request;

class ShowReceivedFriendRequestsController extends Controller
{
    public function __invoke(Request $request)
    {
        $receivedRequests = $request->user()->receivedFriendRequests()
            ->with('user')
            ->where('status', FriendshipStatusEnum::PENDING)
            ->orderByDesc('created_at')
            ->paginate(10);

        return $receivedRequests->toResourceCollection(FriendRequestResource::class);
    }
}
