<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming API authentication request and issue an access token.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        try {
            $request->authenticate();
        } catch (ValidationException) {
            return ApiResponse::error('AUTH-1001', 'Usuario o contraseña incorrectos', 400);
        }

        /** @var User $user */
        $user = $request->user();

        $token = $user->createToken($request->userAgent() ?: 'api-token')->plainTextToken;

        return ApiResponse::success('AUTH-0001', 'Sesión iniciada correctamente', [
            'token' => $token,
            'user' => new UserResource($user),
        ]);
    }

    /**
     * Revoke the token used to authenticate the current request.
     */
    public function destroy(Request $request): Response
    {
        $request->user()->currentAccessToken()->delete();

        // 204 No Content — per the spec, AUTH-0002 does not carry a result/data envelope.
        return response()->noContent();
    }

    /**
     * Return the currently authenticated user.
     */
    public function me(Request $request): JsonResponse
    {
        return ApiResponse::success('AUTH-0004', 'Perfil obtenido correctamente', new UserResource($request->user()));
    }
}
