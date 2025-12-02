<?php

namespace App\Http\Controllers\Friends\Requests;

use App\Enums\FriendshipStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\FriendRequestResource;
use App\Models\Friendship;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CreateFriendRequestController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'friend_id' => ['required', 'integer', 'exists:users,id'],
        ]);

        $incomingRequest = $request->user()->receivedFriendRequests()
            ->where('user_id', $request->friend_id)
            ->where('status', FriendshipStatusEnum::PENDING)
            ->first();

        if ($incomingRequest) {
            throw ValidationException::withMessages([
                'friend_id' => ['This user has already sent you a friend request.'],
            ]);
        }

        $existingRequest = $request->user()->sentFriendRequests()
            ->where('friend_id', $request->friend_id)
            ->where('status', FriendshipStatusEnum::PENDING)
            ->first();

        if ($existingRequest) {
            throw ValidationException::withMessages([
                'friend_id' => ['A friend request has already been sent to this user.'],
            ]);
        }

        $existingFriendship = $request->user()->friends()
            ->where('users.id', $request->friend_id)
            ->first();

        if ($existingFriendship) {
            throw ValidationException::withMessages([
                'friend_id' => ['You are already friends with this user.'],
            ]);
        }

        $friendship = Friendship::create([
            'user_id' => $request->user()->id,
            'friend_id' => $request->friend_id,
            'status' => FriendshipStatusEnum::PENDING,
        ]);

        $sentFriendRequest = $request->user()->sentFriendRequests()->find($friendship->id);
        $sentFriendRequest->load('friend');

        return $sentFriendRequest->toResource(FriendRequestResource::class);
    }
}
