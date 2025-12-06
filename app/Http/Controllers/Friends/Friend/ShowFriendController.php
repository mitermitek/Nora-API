<?php

namespace App\Http\Controllers\Friends\Friend;

use App\Http\Controllers\Controller;
use App\Http\Resources\FriendResource;
use Illuminate\Http\Request;

class ShowFriendController extends Controller
{
    public function __invoke(Request $request, int $id)
    {
        $friend = $request->user()->friends()->findOrFail($id);

        return $friend->toResource(FriendResource::class);
    }
}
