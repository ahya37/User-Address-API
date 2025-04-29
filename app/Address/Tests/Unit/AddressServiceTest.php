<?php

namespace App\Address\Tests\Unit;

use App\Address\Models\Address;
use Tests\TestCase;
use App\Address\Services\AddressService;
use App\User\Services\UserService;
use Illuminate\Database\Eloquent\Collection;

class AddressServiceTest extends TestCase
{
    protected $addressService;
    protected $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->addressService = new AddressService();
        $this->userService = new UserService();
    }

    public function test_get_address_by_user_id(): void
    {
        $user = $this->userService->createUser([
            'name' => 'Ahmad Yani',
            'email' => 'ahmadyani@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $address = $this->addressService->createAddress([
            'user_id' => $user->id,
            'label' => 'Home',
            'recipient_name' => 'Ahmad Yani',
            'phone_number' => '081234567890',
            'address_line' => 'Jl. Imam Bonjol',
            'postal_code' => '12345',
            'city' => 'Jakarta',
            'province' => 'DKI Jakarta',
            'country' => 'Indonesia',
            'is_default' => true,
        ]);
        
        $address = $this->addressService->getAddressByUserId($user->id);

        $this->assertInstanceOf(Collection::class, $address);
        $this->assertDatabaseHas('addresses', [
            'user_id' => $user->id,
            'label' => 'Home',
            'recipient_name' => 'Ahmad Yani',
            'phone_number' => '081234567890',
            'address_line' => 'Jl. Imam Bonjol',
            'postal_code' => '12345',
            'city' => 'Jakarta',
            'is_default' => true,

        ]);
    }

    public function test_show_address_by_user_id_and_address_id(): void
    {
        $user = $this->userService->createUser([
            'name' => 'Ahmad Yani',
            'email' => 'ahmadyani' . time() . '@example.com', // untuk menghindari email yang sama
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $address = $this->addressService->createAddress([
            'user_id' => $user->id,
            'label' => 'Home',
            'recipient_name' => 'Ahmad Yani',
            'phone_number' => '081234567890',
            'address_line' => 'Jl. Imam Bonjol',
            'postal_code' => '12345',
            'city' => 'Jakarta',
            'province' => 'DKI Jakarta',
            'country' => 'Indonesia',
            'is_default' => true,

        ]);

        $address = $this->addressService->showAddressByUserIdAndAddressId($user->id, $address->id);

        $this->assertInstanceOf(Address::class, $address);
        $this->assertEquals($address->user_id, $user->id);
        $this->assertEquals($address->id, $address->id);
        $this->assertEquals($address->label, 'Home');
        $this->assertEquals($address->recipient_name, 'Ahmad Yani');
        $this->assertEquals($address->phone_number, '081234567890');
        $this->assertEquals($address->address_line, 'Jl. Imam Bonjol');
        $this->assertEquals($address->postal_code, '12345');
        $this->assertEquals($address->city, 'Jakarta');
        $this->assertEquals($address->province, 'DKI Jakarta');
        $this->assertEquals($address->country, 'Indonesia');
        $this->assertEquals($address->is_default, true);
        
    }
    
}
