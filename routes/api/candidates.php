<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'search');

Route::get('/info', 'getInfo');

Route::get('workers/{id?}', 'getCandidateId')->whereNumber('id');

Route::post('/', 'store');
