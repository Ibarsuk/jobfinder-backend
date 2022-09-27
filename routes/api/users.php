<?php

use Illuminate\Support\Facades\Route;

Route::post('/', 'store');

Route::post('/login', 'login');

Route::post('/refresh', 'refresh');

Route::post('/logout', 'logout');