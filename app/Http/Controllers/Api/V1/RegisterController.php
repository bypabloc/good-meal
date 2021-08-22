<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;

use Exception;

use \App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $req)
    {
        try{
            $errors = [];

            $name = isset($req->name) ? $req->name : null;
            $email = isset($req->email) ? $req->email : null;
            $password = isset($req->password) ? $req->password : null;
            $password_confirm = isset($req->password_confirm) ? $req->password_confirm : null;
            $device = $req->hasHeader('device') ? $req->header('device') : '';

            if (empty($name)) {
                $errors = [...$errors, 'No indicó un nombre'];
            }
            if (empty($email)) {
                $errors = [...$errors, 'No indicó un correo'];
            }
            if (empty($password)) {
                $errors = [...$errors, 'No indicó una contraseña'];
            }else if (empty($password_confirm)) {
                $errors = [...$errors, 'Debe confirmar la contraseña'];
            }else if ($password !== $password_confirm) {
                $errors = [...$errors, 'Las contraseñas deben coincidir'];
            }

            if (!empty($errors)) {
                return response()->json([
                    'errors' => $errors,
                ], 422);
            }

            $errors = [];

            $queryEmail = User::where('email',$email)->first();

            if (!empty($queryEmail)) {
                $errors = [...$errors, 'El correo ya se encuentra registrado'];
            }

            if (!empty($errors)) {
                return response()->json([
                    'errors' => $errors,
                ], 422);
            }

            $user = new User;
            $user->name = $name;
            $user->email = $email;
            $user->email_verified_at = now();
            $user->password = Hash::make($password);
            $user->remember_token = Str::random(10);
            $user->save();

            if (!Auth::attempt([
                'email' => $email,
                'password' => $password,
            ])) {
                return response()->json([
                    'errors' => ['Unauthorized'],
                ], 401);
            }

            return response()->json([
                'data' => [
                    'token' => $req->user()->createToken($device)->plainTextToken,
                    'name' => $user->name,
                    'email' => $user->email,
                ]
            ]);
        }catch(QueryException $e){
            $result = [
                'errors' => [$e->getMessage(),$e->getLine(),$e->getFile()],
            ];
            return response()->json($result,500);
        }catch(Exception $e){
            $result = [
                'errors' => [$e->getMessage(),$e->getLine(),$e->getFile()],
            ];
            return response()->json($result,500);
        }
    }
}
