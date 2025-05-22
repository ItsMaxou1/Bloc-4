<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return response()->json(['message' => 'Compte utilisateur créé avec succès !']);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json([
                'message' => 'Connexion réussie.',
                'user' => [
                    'id' => $user->id,
                    'firstname' => $user->name, // ou $user->firstname si tu as une colonne dédiée
                    'email' => $user->email,
                    'role' => $user->role
                ]
            ]);
        }

        return response()->json(['message' => 'Identifiants invalides'], 401);
    }

}