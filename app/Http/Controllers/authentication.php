<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class authentication extends Controller
{
    
    protected function register(Request $request)
    {
        $request->validate([
            'name'      => 'alpha|min:3|max:25|required',
            'surname'   => 'alpha|min:3|max:30|required',
            'email'     => 'email|required',
            'password'  => 'alpha_dash|min:8|max:25|confirmed|required'
        ]);

        $user = new User([
            'name'      => $request->get('name'),
            'surname'   => $request->get('surname'),
            'email'     => $request->get('email'),
            'password'  => Hash::make($request->get('password'))
        ]);

        $user->save();

        return redirect('/login');
    }

    protected function login(Request $request)
    {
        $request->validate([
            'email'    => 'email|required',
            'password' => 'alpha_dash|min:8|max:25|required'
        ]);

        if(Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')]))
        {
            $request->session()->regenerate();

            return redirect('/');
        }
    }

    protected function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

}
