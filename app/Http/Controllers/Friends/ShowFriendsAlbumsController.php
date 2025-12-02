<?php

namespace App\Http\Controllers\Friends;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class ShowFriendsAlbumsController extends Controller
{
    public function __invoke(Request $request)
    {
        $userFriends = $request->user()->friends()->pluck('users.id');
        $friendsAlbums = Album::with(['photos', 'user'])
            ->whereIn('user_id', $userFriends)
            ->orderByDesc('created_at')
            ->paginate(10);

        return $friendsAlbums->toResourceCollection();
    }
}
