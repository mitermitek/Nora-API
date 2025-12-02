<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\AuthenticatedUserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        if (! Auth::attempt($validated)) {
            return Response::json([
                'message' => 'The provided credentials are incorrect.',
            ], 401);
        }

        $request->session()->regenerate();

        $user = Auth::user();
        $authenticatedUserResource = $user->toResource(AuthenticatedUserResource::class);

        return $authenticatedUserResource;
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Response::noContent();
    }

    public function me()
    {
        $user = Auth::user();
        $authenticatedUserResource = $user->toResource(AuthenticatedUserResource::class);

        return $authenticatedUserResource;
    }
}
