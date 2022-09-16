<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Token;
use App\Models\User;
use App\Services\Auth\TokenService;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public static function store(CreateUserRequest $req) {
        $validated = $req->validated();
        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);
    }

    public static function login(LoginRequest $req) {
        
        abort_if(!Auth::validate($req->validated()), 400);

        $user = Auth::user();
        ["token" => $access] = TokenService::createJwtAccessToken($user->attributesToArray());
        ["token" => $refresh, "expires" => $refreshExpires] = TokenService::createJwtRefreshToken();
        
        $user->tokens()->create(['token' => $refresh, 'expires' => $refreshExpires]);

        return ["access" => $access, "refresh" => $refresh];
    }
}
