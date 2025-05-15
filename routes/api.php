<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



require __DIR__ . '/../app/Auth/routes.php';
require __DIR__ . '/../app/Address/routes.php';


Route::middleware(['jwt.auth'])->group(function(){
    require __DIR__ . '/../app/User/routes.php';
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('jwt.auth');

