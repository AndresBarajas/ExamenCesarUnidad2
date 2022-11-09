<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;


class LoginController extends Controller
{
    public function Login(Request $request){

        $data = $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|min:6'
        ]);

        $usuarios = Usuario::where('email',$data['email'])
                             ->where('password',$data ['password'])
                             ->first();

        if(!$usuarios){
            return response([
                'message' => 'no existe las credenciales xd'
            ], 404);

        }

        $token = $usuarios->createToken('user-token')
                          ->plainTextToken;

        return response([
            'usuario' => $usuarios,
            'token'=>$token

        ]);


    }



}


