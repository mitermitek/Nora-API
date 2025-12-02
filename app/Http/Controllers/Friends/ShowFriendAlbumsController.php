<?php

namespace App\Http\Controllers\Friends;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class ShowFriendAlbumsController extends Controller
{
    public function __invoke(Request $request, int $id)
    {
        $friend = $request->user()->friends()->findOrFail($id);
        $friendAlbums = Album::with('photos')
            ->where('user_id', $friend->id)
            ->paginate(10);

        return $friendAlbums->toResourceCollection();
    }
}
