<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Token;
use App\Models\User;
use App\Services\Auth\TokenService;
use Exception;
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
        
        abort_if(!Auth::validate($req->validated()), 400, 'Invalid email or password');

        $user = Auth::user();
        $tokens = TokenService::createTokens($user);

        return ["tokens" => $tokens, "user" => $user];
    }

    public static function refresh(Request $req) {
        $sentToken = $req->validate(['token' => 'required|string'])['token'];

        try {
            $payload = TokenService::verify($sentToken, 'refresh');
        } catch(Exception $e) {
            abort(401);
        }

        $dbToken = Token::where([['user_id', $payload->id], ['token', $sentToken]]);

        if (!$dbToken) abort(401);

        $dbToken->delete();
        $user = User::find($payload->id);
        $tokens = TokenService::createTokens($user);

        return ["tokens" => $tokens, "user" => $user];
    }

    public static function logout(Request $req) {
        $sentToken = $req->validate(['token' => 'required|string'])['token'];

        try {
            $payload = TokenService::verify($sentToken, 'refresh');
        } catch (Exception $e) {
            abort(400);
        }

        $deletedTokensNumber = Token::where([['user_id', $payload->id], ['token', $sentToken]])->delete();

        abort_if(!$deletedTokensNumber, 404);
    }
}
