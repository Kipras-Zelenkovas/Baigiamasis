<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories as ModelsCategories;
use Illuminate\Http\Request;

class Categories extends Controller
{

    public function add(){
        return view('admin.categories');
    }
    
    public function create(Request $request){
        try {
            $request->validate([
                'name'
            ]);

            $category = ModelsCategories::create([
                'name'  => $request->name
            ]);

            return redirect('/products');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

}
