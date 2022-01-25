<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\post;

class posts extends Controller
{
    
    protected function create(Request $request)
    {
        $request->validate([
            'name'        => 'alpha_dash|max:70|required',
            'description' => 'alpha_dash|required',
            'image'       => 'image|required'
        ]);

        $post = new post([
            'user_id' => Auth::id(),
        ]);

    }

}
