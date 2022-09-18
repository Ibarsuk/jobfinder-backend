<?php

namespace App\Services\Auth;

use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class TokenService {
    public static function createJwtAccessToken($payload = []) {
        $currentTime = time();
        $expirationTime = $currentTime + config('jwt.expires.access');
        $token =  JWT::encode(
            $payload + 
            [
                'iat' => $currentTime, 
                'exp' => $expirationTime
            ],
            config('jwt.keys.access'),
            config('jwt.algorithm')
        );

        return ['token' => $token, 'expires' => $expirationTime];
    }

    public static function createJwtRefreshToken($payload = []) {
        $currentTime = time();
        $refreshExpirationDays = config('jwt.expires.refresh');
        $expirationTime = strtotime("+{$refreshExpirationDays} days", $currentTime);
        $token = JWT::encode(
            $payload + 
            [
                'iat' => $currentTime, 
                'exp' => $expirationTime
            ],
            config('jwt.keys.refresh'),
            config('jwt.algorithm')
        );
        return ['token' => $token, 'expires' => $expirationTime];
    }

    public static function verify($token, $tokenType) {
        return JWT::decode($token, new Key(config("jwt.keys.$tokenType"), config('jwt.algorithm')));
    }

    public static function createTokens(User $user) {
        ["token" => $access] = TokenService::createJwtAccessToken(['user' => $user->attributesToArray()]);
        ["token" => $refresh, "expires" => $refreshExpires] = TokenService::createJwtRefreshToken(['id' => $user->id]);
        
        $user->tokens()->create(['token' => $refresh, 'expires' => $refreshExpires]);

        return ["access" => $access, "refresh" => $refresh];
    }
}