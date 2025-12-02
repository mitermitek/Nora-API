<?php

namespace App\Http\Controllers\Friends;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;

class ShowFriendsPhotosController extends Controller
{
    public function __invoke(Request $request)
    {
        $userFriends = $request->user()->friends()->pluck('users.id');
        $friendsPhotos = Photo::with('user')
            ->whereIn('user_id', $userFriends)
            ->orderByDesc('created_at')
            ->paginate(10);

        return $friendsPhotos->toResourceCollection();
    }
}
