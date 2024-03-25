<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;


class AuthenticatedSessionController extends Controller
{

    public function store(LoginRequest $request): JsonResponse
    {
        try {
            Log::info('Attempting user authentication...');
            $request->authenticate();
            Log::info('User authenticated successfully.');

            Log::info('Accessing authenticated user...');
            $user = $request->user();
            Log::info('User retrieved successfully.');

            Log::info('Logging in user...');
            Auth::login($user);
            Log::info('User logged in successfully.');

            $token = $user->createToken('token-name')->plainTextToken;
            $userType = $user->usertype;

            Log::info('Storing token in session...');
            session(['token' => $token]);
            Log::info('Token stored in session successfully.');

            return response()->json(['token' => $token, 'usertype' => $userType, 'message' => 'Sessão iniciada']);

<<<<<<< HEAD
=======
            switch ($user->rol->name) {
                case 'Admin':
                    return response()->json(['token' => $token, 'message' => 'Inicio de sesión exitoso', 'rol' => 'Admin']);
                    break;
                case 'User':
                    return response()->json(['token' => $token, 'message' => 'Inicio de sesión exitoso', 'rol' => 'User']);
                    break;
                default:
                    return response()->json(['message' => 'Rol no reconocido: ' . $user->rol->name], 403);
            }
>>>>>>> b14085cc09a204c73eed9fa34c020dbeb42c05b5
        } catch (\Exception $e) {
            Log::error('Error during login: ' . $e->getMessage());
            return response()->json(['message' => 'E-mail ou senha incorretos'], 401);
        }
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
{
    try {
        if ($request->user()) {
            $request->user()->tokens()->delete();
            Auth::guard('web')->logout();
            return response()->json(['message' => 'Sessão encerrada']);
        } else {
            return response()->json(['message' => 'Usuário não autenticado'], 401);
        }
    } catch (\Exception $e) {
        Log::error('Erro de logout: ' . $e->getMessage());
        return response()->json(['message' => 'Erro de logout'], 500);
    }
    }
}