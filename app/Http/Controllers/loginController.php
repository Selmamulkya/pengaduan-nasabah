<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class loginController extends Controller
{
    public function showLoginForm()
    {
        return view('login-nasabah'); // pastikan file view 'login.nasabah' ada
    }
}
