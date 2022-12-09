<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Products as ModelsProducts;
use App\Models\Products_images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Products extends Controller
{

    public function index(Request $request){
        $pagination = 10;

        $products = ModelsProducts::where('id', '>', ($request->page-1) * $pagination)->paginate($pagination);

        return view('main', ['products' => $products, 'page' => $request->page]);
    }

    public function find(Request $request){
        return view('product', ['product' => ModelsProducts::find($request->id)]);
    }

    public function byCategory(Request $request){
        try {
            $pagination = 10;

            $products = ModelsProducts::where('category', $request->category)->where('id', '>', ($request->page-1) * $pagination)->paginate($pagination);

            return view('main', ['products' => $products, 'page' => $request->page]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function create(Request $request){
        try {
            $request->validate([
                'name'          => 'required',
                'price'         => 'required',
                'description'   => 'required',
                'quantity'      => 'required',
                'category_id'   => 'required',
                'images.*'      => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
    
            $product = ModelsProducts::create([
                'name'          => $request->name,
                'price'         => $request->price,
                'description'   => $request->description,
                'quantity'      => $request->quantity,
                'user_id'       => Auth::id(),
                'category_id'   => $request->category_id
            ]);
    
            $product->save();
    
            if($request->hasfile('image')){
                foreach($request->file('image') as $image){
                    $name = $image->getClientOriginalName();
                    $image->move(public_path().'/images/', $name);  
                        
                    $product_image = Products_images::create([
                        'products_id'   => $product->id,
                        'name'          => $name
                    ]);
    
                    $product_image->save();
                }
            }

            return redirect('/products');

        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }

    }

    public function update(Request $request){
        try {
            $request->validate([
                'name'          => 'required',
                'price'         => 'required',
                'description'   => 'required',
                'quantity'      => 'required',
                'category_id'   => 'required'
            ]);
    
            $product = ModelsProducts::find($request->id);
    
            $product->name          = $request->name;
            $product->price         = $request->price;
            $product->description   = $request->description;
            $product->quantity      = $request->quantity;
            $product->category_id   = $request->category_id;

            $product->save();
    
           return redirect('/products/product?id='. $request->id);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function delete(Request $request){
        $product = ModelsProducts::find($request->id);

        $product->delete();

        return redirect('/products');
    }



}
