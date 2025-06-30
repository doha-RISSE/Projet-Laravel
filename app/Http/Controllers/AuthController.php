<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    public function register(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed|min:6',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        // 'role' => 'user', // pas besoin si t'as un `default('user')`
    ]);

    return response()->json([
        'message' => 'Utilisateur enregistré avec succès',
        'user' => $user
    ], 201);
}

public function login(Request $request)
{
    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Email ou mot de passe incorrect'], 401);
    }

    $token = $user->createToken('userToken')->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $user
    ]);
}

}
