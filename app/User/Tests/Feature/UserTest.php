<?php

namespace App\User\Tests\Feature;

use App\User\Services\UserService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = new UserService();
    }

    public function test_user_can_be_get_all()
    {
        $response = $this->getJson('/api/users');

        $response->assertStatus(200)
            ->assertJson([
                'meta' => [
                    'code' => 200,
                    'message' => 'Users fetched successfully',
                ],
                'data' => $response->json()['data'],
            ]);
    }

    public function test_user_can_be_created()
    {
        $requestBody = [
            'name' => 'Ahmad Yani',
            'email' => 'ahmadyani@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->postJson('/api/users', $requestBody);

        $response->assertStatus(201)
            ->assertJson([
                'meta' => [
                    'code' => 201,
                    'message' => 'User created successfully',
                ],
                'data' => [
                    'id' => $response->json()['data']['id'],
                    'name' => $requestBody['name'],
                    'email' => $requestBody['email'],
                    'created_at' => $response->json()['data']['created_at'],
                    'updated_at' => $response->json()['data']['updated_at'],
                ],
            ]);
    }

    public function test_user_can_be_show_by_id()
    {
        $user = $this->userService->createUser([
            'name' => 'Ahmad Yani',
            'email' => 'ahmadyani@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response = $this->getJson('/api/users/' . $user->id);

        $response->assertStatus(200)
            ->assertJson([
                'meta' => [
                    'code' => 200,
                    'message' => 'User fetched successfully',
                ],
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'created_at' => $response->json()['data']['created_at'],
                    'updated_at' => $response->json()['data']['updated_at'],
                ],
            ]);
    }

    public function test_user_can_be_updated()
    {
        $user = $this->userService->createUser([
            'name' => 'Ahmad Yani',
            'email' => 'ahmadyani@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $requestBody = [
            'name' => 'Ahmad Yani Updated',
            'email' => 'ahmadyani@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->putJson('/api/users/' . $user->id, $requestBody);

        $response->assertStatus(200)
            ->assertJson([
                'meta' => [
                    'code' => 200,
                    'message' => 'User updated successfully',
                ],
                'data' => [
                    'id' => $user->id,
                    'name' => $requestBody['name'],
                    'email' => $requestBody['email'],
                    'created_at' => $response->json()['data']['created_at'],
                    'updated_at' => $response->json()['data']['updated_at'],
                ],
            ]);
    }

    public function test_user_can_be_deleted()
    {
        $user = $this->userService->createUser([
            'name' => 'Ahmad Yani',
            'email' => 'ahmadyani@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response = $this->deleteJson('/api/users/' . $user->id);

        $response->assertStatus(200)
            ->assertJson([
                'meta' => [
                    'code' => 200,
                    'message' => 'User deleted successfully',
                ],
            ]);
    }
}
