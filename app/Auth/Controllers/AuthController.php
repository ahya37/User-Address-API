<?php

namespace App\Auth\Controllers;

use App\Auth\Requests\LoginRequest;
use App\Auth\Services\AuthService;
use App\Helpers\ResponseFormatter;
use Illuminate\Routing\Controller;
use App\User\Requests\CreateUserRequest;
use App\User\Requests\UpdateUserRequest;
use App\User\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller 
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request) : JsonResponse
    {
        $credential = $request->only('email','password');
        $user       = $this->authService->login($credential);
        return ResponseFormatter::success($user, 'Login successfully');

    }

}