<?php

namespace App\Address\Tests\Feature;

use Tests\TestCase;
use App\Address\Services\AddressService;
use App\User\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    protected $addressService;
    protected $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->addressService = new AddressService();
        $this->userService = new UserService();
    }

    public function test_list_user_address_by_user_id()
    {
        $user = $this->userService->createUser([
            'name' => 'Ahmad Yani',
            'email' => 'ahmadyani' . time() . '@example.com', // memakai time untuk menghindari email yang sama
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $addresses = [];
        for ($i = 0; $i < 5; $i++) {
            $address = $this->addressService->createAddress([
                'user_id' => $user->id,
                'label' => 'Home',
                'recipient_name' => 'Ahmad Yani',
                'phone_number' => '081234567890',
                'address_line' => 'Jalan Raya No. 123',
                'postal_code' => '12345',
                'city' => 'Jakarta',
                'province' => 'DKI Jakarta',
                'country' => 'Indonesia',
                'is_default' => true,
            ]);
            $addresses[] = $address;
        }

        $response = $this->getJson('/api/users/' . $user->id . '/addresses');
        $response->assertStatus(200);

        $response->assertJson([
            'meta' => [
                'code' => 200,
                'message' => 'Addresses fetched successfully',
            ],
            'data' => $response->json()['data'],
        ]);
    }

    public function test_show_address_by_user_id_and_address_id()
    {
        $user = $this->userService->createUser([
            'name' => 'Ahmad Yani',
            'email' => 'ahmadyani' . time() . '@example.com', // memakai time untuk menghindari email yang sama
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $address = $this->addressService->createAddress([
            'user_id' => $user->id,
            'label' => 'Home',
            'recipient_name' => 'Ahmad Yani',
            'phone_number' => '081234567890',
            'address_line' => 'Jalan Raya No. 123',
            'postal_code' => '12345',
            'city' => 'Jakarta',
            'province' => 'DKI Jakarta',
            'country' => 'Indonesia',
            'is_default' => true,
        ]);

        $response = $this->getJson('/api/users/' . $user->id . '/addresses/' . $address->id);
        $response->assertStatus(200);

        $response->assertJson([
            'meta' => [
                'code' => 200,
                'message' => 'Address fetched successfully',
            ],
            'data' => $response->json()['data'],
        ]);
    }
    
}
