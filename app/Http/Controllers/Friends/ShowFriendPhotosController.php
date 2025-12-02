<?php

namespace App\Http\Controllers\Friends;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;

class ShowFriendPhotosController extends Controller
{
    public function __invoke(Request $request, int $id)
    {
        $friend = $request->user()->friends()->findOrFail($id);
        $friendPhotos = Photo::where('user_id', $friend->id)->paginate(10);

        return $friendPhotos->toResourceCollection();
    }
}
