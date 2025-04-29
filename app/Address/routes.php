<?php

use Illuminate\Support\Facades\Route;
use App\Address\Controllers\AddressController;


Route::prefix('users')->group(function () {
    Route::get('/{userId}/addresses', [AddressController::class, 'listUserAddressByUserId']);
    Route::get('/{userId}/addresses/{addressId}', [AddressController::class, 'showAddressByUserIdAndAddressId']);
    Route::post('/{userId}/addresses', [AddressController::class, 'createAddress']);
});