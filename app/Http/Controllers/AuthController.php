<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RequestLogin;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @param RequestLogin $request
     * @return JsonResponse
     */
    public function login(RequestLogin $request): JsonResponse
    {
        $fields = $request->validated();

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json([
                'message' => 'Hata, kullanıcı adı veya şifre yanlış.',
            ], 401);
        }

        // Create token
        $token = $user->createToken('myapptoken')->plainTextToken;

        // Response
        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    /**
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        if ($request->user()->tokens()->delete()) {

            // Response
            return response()->json([
                'message' => 'Başarılı, çıkış yapıldı.',
            ], 201);
        }
    }
}
