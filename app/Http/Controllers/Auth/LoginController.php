<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        $user = User::where('email', request('email'))->first();

        if (!$user || !Hash::check(request('password'), $user->password)) {
            return response("Credenciais inválidas", 413);
        } else {
            $token = $user->createToken('login')->plainTextToken;

            return response([
                'token' => $token,
                'user_id' => $user['id']
            ], 200); 
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response("Usuário deslogado", 200);
    }
}
