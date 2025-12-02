<?php

namespace App\Http\Controllers\Token;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RevokeCurrentTokenController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->noContent();
    }
}
