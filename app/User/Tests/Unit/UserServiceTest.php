<?php

namespace App\User\Tests\Unit;

use Tests\TestCase;
use App\User\Services\UserService;
use App\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = new UserService();
    }

    public function test_get_all_users(): void
    {
        $user = $this->userService->createUser([
            'name' => 'Ahmad Yani',
            'email' => 'ahmadyani@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $users = $this->userService->getAllUsers();

        $this->assertInstanceOf(Collection::class, $users);
        $this->assertCount(1, $users);
        $this->assertEquals($user->id, $users->first()->id);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ]);
    }

    public function test_create_user(): void 
    {
        $requestBody = [
            'name' => 'Ahmad Yani',
            'email' => 'ahmadyani@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $user = $this->userService->createUser($requestBody);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($requestBody['name'], $user->name);
        $this->assertEquals($requestBody['email'], $user->email);
        $this->assertTrue(Hash::check($requestBody['password'], $user->password)); 
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $requestBody['name'],
            'email' => $requestBody['email'],
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ]);

    }

    public function test_show_user_by_id(): void
    {
        $user = $this->userService->createUser([
            'name' => 'Ahmad Yani',
            'email' => 'ahmadyani@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $user = $this->userService->showUserById($user->id);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($user->id, $user->id);
        $this->assertEquals($user->name, $user->name);
        $this->assertEquals($user->email, $user->email);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ]);
    }

    public function test_update_user(): void
    {
        $user = $this->userService->createUser([
            'name' => 'Ahmad Yani',
            'email' => 'ahmadyani@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $requestBody = [
            'name' => 'Ahmad Yani update',
            'email' => 'ahmadyani@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $user = $this->userService->updateUser($user->id, $requestBody);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($requestBody['name'], $user->name);
        $this->assertEquals($requestBody['email'], $user->email);
        $this->assertTrue(Hash::check($requestBody['password'], $user->password));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $requestBody['name'],
            'email' => $requestBody['email'],
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ]);
    }

    public function test_delete_user(): void
    {
        $user = $this->userService->createUser([
            'name' => 'Ahmad Yani',
            'email' => 'ahmadyani@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->userService->deleteUser($user->id);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }
}
