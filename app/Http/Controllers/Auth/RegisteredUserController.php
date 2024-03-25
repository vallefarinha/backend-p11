<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class RegisteredUserController extends Controller
{
    public function store(Request $request): JsonResponse
    {


        Log::info('Dados recebidos no registro do usuário:', $request->all());
        Log::info('Name:', ['name' => $request->input('name')]);

        try {

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'address' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:255'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);
            $token = $user->createToken('remember_token')->plainTextToken;
            $user->update(['remember_token' => $token]);

            Log::info('Token gerado: ' . $token);
            event(new Registered($user));
            // Log de sucesso
            Log::info('Usuário registrado com sucesso: ' . $user->email);

            return response()->json(['data'=> $user, 'remember_token' => $token, 'token_type' => 'Bearer', 'message' => 'Inicio de sesión exitoso'], 201);
        } catch (\Exception $e) {
            // Log de erro
            Log::error('Erro durante o registro do usuário: ' . $e->getMessage());

            return response()->json(['error' => 'Erro interno do servidor. Por favor, tente novamente mais tarde.'], 500);
        }
    }
}

?>
