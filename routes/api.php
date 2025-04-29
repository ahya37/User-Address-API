<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/../app/User/routes.php';
require __DIR__ . '/../app/Address/routes.php';

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

