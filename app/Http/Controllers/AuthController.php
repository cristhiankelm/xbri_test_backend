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
        // Validar os dados de login
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        // Verificar se os dados de login estão corretos
        if (Auth::attempt($credentials)) {
            Session::regenerateToken();

            return response()->json([
                'user' => Auth::user(),
                'token' => Auth::user()
                    ->createToken('token')
                    ->plainTextToken,
            ]);
        }

        // Retornar uma mensagem de erro se os dados de login não estiverem corretos
        return response()->json([
            'message' => 'Os dados informados não conferem!',
        ], 401);
    }

    // Método para desconectar o usuário
    public function logout(): JsonResponse
    {
        // Verificar se o usuário está autenticado
        $user = auth()->user();

        // Retornar uma mensagem de erro se o usuário não estiver autenticado
        if (! $user) {
            return response()->json([
                'message' => 'Erro o executar operação',
            ], 401);
        }

        // Excluir todos os tokens do usuário
        $user->tokens()->delete();

        // Retornar uma mensagem de sucesso ao desconectar o usuário
        return response()->json([
            'message' => 'Usuário desconectado',
        ]);
    }
}
