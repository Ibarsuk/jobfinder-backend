<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'show')->middleware('auth');

Route::post('/', 'store');

Route::post('/login', 'login');

Route::post('/refresh', 'refresh');

Route::post('/logout', 'logout');