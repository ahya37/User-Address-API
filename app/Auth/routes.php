<?php 

use App\Auth\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/login',[AuthController::class,'login']);