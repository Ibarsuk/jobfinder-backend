<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('candidates')->
    prefix('candidates')->
    controller(CandidateController::class)->
    middleware('auth')->
    group(__DIR__.'/candidates.php');

Route::name('users')->
    prefix('users')->
    controller(UserController::class)->
    group(__DIR__.'/users.php');
