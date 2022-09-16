<?php

namespace App\Services\Auth;

use Firebase\JWT\JWT;

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
        $expirationTime = strtotime("+{config(jwt.expires.refresh)} days", $currentTime);
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
}