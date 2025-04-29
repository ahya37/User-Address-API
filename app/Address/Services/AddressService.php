<?php

namespace App\Address\Services;

use App\Address\Models\Address;
use Illuminate\Database\Eloquent\Collection;

class AddressService
{
    public function getAddressByUserId(int $userId): Collection
    {
        return Address::where('user_id', $userId)->get();
    }

    public function createAddress(array $data): Address
    {
        return Address::create($data);
    }

    public function showAddressByUserIdAndAddressId(int $userId, int $addressId): ?Address
    {
        return Address::where('user_id', $userId)->where('id', $addressId)->first();
    }

}
