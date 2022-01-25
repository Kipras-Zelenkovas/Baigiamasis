<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class views extends Controller
{
    protected function main()
    {
        return view('main');
    }

    protected function register()
    {
        return view('register');
    }

    protected function login()
    {
        return view('login');
    }
}
