<?php

namespace App\Services\Auth;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JWTGuard implements Guard {

    protected $request;
    protected $provider;
    protected ?Authenticatable $user = null;

    public function __construct(UserProvider $provider, Request $request) {
        $this->request = $request;
        $this->provider = $provider;
    }

    public function  check() {
        try {
            $token = $this->request->bearerToken();
            if (!$token) return false;

            $payload = JWT::decode($token, new Key(config('jwt.keys.access'), config('jwt.algorithm')));
            $user = (object) $payload->user;

            if (!$user) return false;
            
            $this->setUser($user);

            return true;
        } catch(Exception $e) {
            Log::debug("Failed attempt to authenticate");
            return false;
        }


    }

    public function guest() {
        return !$this->user;
    }

    public function user() {
        return $this->user;
    }

    public function id() {
        return $this->user?->id;
    }

    public function validate(array $credentials = []) {
        if (!$credentials['email'] || !$credentials['password'])  
            return false;

        // TODO:roles in future woun't be attached
        $user = $this->provider->retrieveByCredentials($credentials);

        if (!($user && $this->provider->validateCredentials($user, $credentials)))
            return false;

        $this->setUser($user);

        return true;
    }

    public function hasUser() {
        return !empty($this->user);
    }

    public function setUser($user) {
        $this->user = $user;
        return $this;
    }
}