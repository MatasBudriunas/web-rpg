<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Factories\UserFactory;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private UserFactory $userFactory;

    public function __construct(UserFactory $userFactory){
        $this->userFactory = $userFactory;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->userFactory->create($request->validated());

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json(['token' => $token], Response::HTTP_CREATED);
    }

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken('auth-token')->plainTextToken;
            Auth::login($request->user());

            return response()->json(['token' => $token], Response::HTTP_OK);
        }

        return response()->json(['error' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully'], Response::HTTP_OK);
    }
}
