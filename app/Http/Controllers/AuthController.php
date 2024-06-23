<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function attempt(Request $request): JsonResponse
    {
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        if (Auth::attempt($credentials)) {
            Session::regenerateToken();

            return response()->json([
                'user' => Auth::user(),
                'token' => Auth::user()
                    ->createToken('token')
                    ->plainTextToken,
            ]);
        }

        return response()->json([
            'message' => 'Os dados informados não conferem!',
        ], 401);
    }

    public function logout(): JsonResponse
    {
        $user = auth()->user();

        if (! $user) {
            return response()->json([
                'message' => 'Erro o executar operação',
            ], 401);
        }

        // Excluir todos os tokens do usuário
        $user->tokens()->delete();

        return response()->json([
            'message' => 'Usuário desconectado',
        ]);
    }
}
