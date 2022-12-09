<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class Views extends Controller
{
    
    public function login(){
        return view('auth.login');
    }

    public function register(){
        return view('auth.register');
    }

    public function add_product(){

        $categories = Categories::all();

        return view('add_product', ['categories' => $categories]);
    }

    public function update_product(Request $request){
        $product = Products::find($request->id);
        $categories = Categories::all();

        return view('update_product', ['product' => $product, 'categories' => $categories]);
    }

    public function forgot_password(){
        return view('auth.forgot-password');
    }

    public function reset_password($token, Request $request){
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

}
