<?php

namespace App\Http\Controllers\Friends;

use App\Http\Controllers\Controller;
use App\Http\Resources\FriendResource;
use Illuminate\Http\Request;

class ShowFriendsController extends Controller
{
    public function __invoke(Request $request)
    {
        $userFriends = $request->user()->friends()
            ->orderBy('name')
            ->paginate(10);

        return $userFriends->toResourceCollection(FriendResource::class);
    }
}
