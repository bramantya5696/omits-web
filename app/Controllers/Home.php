<?php

namespace App\Controllers;

use App\Models\User;

class Home extends BaseController
{
    public function index()
    {
        return view('home');
    }

    public function login()
    {
        $data = [
            'title' => 'login'
        ];
        echo view('auth/login', $data);
    }

    public function registration()
    {
        return view('auth/registration', ['title'	=>	'Registration']);
    }

    public function forgotPassword()
    {
        return view('auth/forgot_password', ['title'	=>	'Forgot Password']);
    }

    public function resetpassword()
    {
        $id = session()->get('reset_id');
        if (!$id) {
            return redirect('login');
        }
        return view('auth/reset_password', ['title'	=>	'Reset Password']);
    }


}
