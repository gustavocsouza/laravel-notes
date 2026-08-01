<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request) 
    {
        $request->validate(
            [
                'text_username' => 'required|email',
                'text_password' => 'required|min:6|max:16',
            ],
            [
                'text_username.required' => 'O username é obrigatório.',
                'text_username.email' => 'O username deve ser um e-mail válido.',
                'text_password.required' => 'O password é obrigatório.',
                'text_password.min' => 'O password deve ter no mínimo :min caracteres',
                'text_password.max' => 'O password deve ter no máximo :max carateres',
            ]
        );  

        $username = $request->input('text_username');
        $password = $request->input('text_password');

        echo 'OK';
    }

    public function logout()
    {

    }
}
