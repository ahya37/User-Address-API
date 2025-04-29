<?php

namespace App\Address\Controllers;

use App\Address\Services\AddressService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Helpers\ResponseFormatter;

class AddressController extends Controller
{
    protected $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    public function listUserAddressByUserId($userId)
    {
        $addresses = $this->addressService->getAddressByUserId($userId);
        return ResponseFormatter::success($addresses, 'Addresses fetched successfully', 200);
    }

    public function createAddress(Request $request)
    {
        $address = $this->addressService->createAddress($request->all());
        return ResponseFormatter::success($address, 'Address created successfully', 201);
    }

    public function showAddressByUserIdAndAddressId($userId, $addressId)
    {
        $address = $this->addressService->showAddressByUserIdAndAddressId($userId, $addressId);
        return ResponseFormatter::success($address, 'Address fetched successfully', 200);
    }
    
}