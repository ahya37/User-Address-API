<?php

namespace App\User\Controllers;

use App\Helpers\ResponseFormatter;
use Illuminate\Routing\Controller;
use App\User\Requests\CreateUserRequest;
use App\User\Requests\UpdateUserRequest;
use App\User\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $userService;
    

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    

    public function index(): JsonResponse
    {
        $users = $this->userService->getAllUsers();
        return ResponseFormatter::success($users, 'Users fetched successfully');
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {


            $user = $this->userService->createUser($request->all());

            $users = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ];

            DB::commit();
            return ResponseFormatter::success($users, 'User created successfully',201);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error(['error' => $e->getMessage()]);
            return ResponseFormatter::error('Error create user');
        }
    }

    public function show(int $id): JsonResponse
    {
        $user = $this->userService->showUserById($id);
        $users = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ];
        return ResponseFormatter::success($users, 'User fetched successfully', 200);
    }

    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        
        $user = $this->userService->updateUser($id, $request->all());
        return ResponseFormatter::success($user, 'User updated successfully', 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->userService->deleteUser($id);
        return ResponseFormatter::success(null, 'User deleted successfully', 200);
    }
}
