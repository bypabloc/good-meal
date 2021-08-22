<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $req)
    {
        $errors = [];

        $email = isset($req->email) ? $req->email : null;
        $password = isset($req->password) ? $req->password : null;
        $device = $req->hasHeader('device') ? $req->header('device') : '';

        if (empty($email)) {
            $errors = [...$errors, 'No indicó un email'];
        }
        if (empty($password)) {
            $errors = [...$errors, 'No indicó una contraseña'];
        }

        if (!empty($errors)) {
            return response()->json([
                'errors' => $errors,
            ], 422);
        }

        $credentials = [
            'email' => $email,
            'password' => $password,
        ];

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'errors' => ['Unauthorized']
            ], 401);
        }
        
        $queryResult = User::where('email',$email)->first();

        return response()->json([
            'data' => [
                'token' => $req->user()->createToken($device)->plainTextToken,
                'name' => $queryResult->name,
                'email' => $queryResult->email,
            ]
        ]);
    }
    
    public function logout(Request $req)
    {
        Auth::user()->tokens()->delete();

        return response()->json([
            'message' => ['Deslogueo exitoso'],
        ]);
    }


}
