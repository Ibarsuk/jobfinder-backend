<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public static function store(CreateUserRequest $req) {
        //dd($req->validated());
        User::create($req->validated());
    }
}
