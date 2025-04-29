<?php

namespace App\User\Services;

use App\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Collection;
class UserService
{
    public function getAllUsers(): Collection
    {
        return User::all();
    }

    public function createUser(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    public function showUserById(int $id): User
    {
        return User::findOrFail($id);
    }

    public function updateUser(int $id, array $data): User
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function deleteUser(int $id): void
    {
        $user = User::findOrFail($id);
        $user->delete();

    }
}