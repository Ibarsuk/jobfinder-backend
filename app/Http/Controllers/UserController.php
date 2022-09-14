<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public static function store(CreateUserRequest $req) {
        $validated = $req->validated();
        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);
    }
}
