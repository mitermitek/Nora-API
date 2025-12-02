<?php

namespace App\Http\Controllers\Friends\Requests;

use App\Enums\FriendshipStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Friendship;
use Illuminate\Http\Request;

class AcceptFriendRequestController extends Controller
{
    public function __invoke(Request $request, int $id)
    {
        $friendRequest = Friendship::where('id', $id)
            ->where('status', FriendshipStatusEnum::PENDING)
            ->where('friend_id', $request->user()->id)
            ->firstOrFail();

        $friendRequest->update([
            'status' => FriendshipStatusEnum::ACCEPTED,
        ]);

        return response()->noContent();
    }
}
