<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
     use ApiResponse;

     public function register(Request $request)
     {
          $fields = $request->validate([
               'name' => 'required|string|max:50',
               'email' => 'required|string|email|unique:users,email',
               'password' => 'required|string|min:6',
          ]);

          $user = User::create([
               'name' => $fields['name'],
               'email' => $fields['email'],
               'password' => bcrypt($fields['password']),
          ]);

          $token = $user->createToken('auth_token')->plainTextToken;

          return $this->success([
               'user' => $user,
               'token' => $token
          ], 'Usuario registrado correctamente', 201);
     }

     public function login(Request $request)
     {
          $fields = $request->validate([
               'email' => 'required|string|email',
               'password' => 'required|string',
          ]);

          $user = User::where('email', $fields['email'])->first();

          if (!$user || !Hash::check($fields['password'], $user->password)) {
               return $this->error('Credenciales incorrectas', 401);
          }

          $token = $user->createToken('auth_token')->plainTextToken;

          return $this->success([
               'user' => $user,
               'token' => $token
          ], 'Inicio de sesión exitoso');
     }

     public function logout(Request $request)
     {
          $request->user()->tokens()->delete();
          return $this->success([], 'Sesión cerrada correctamente');
     }
}
