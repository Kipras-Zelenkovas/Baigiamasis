@extends('layouts.mainlayout')

@section('content')
    
<div class="container-fluid">
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card bg-dark text-white" style="border-radius: 1rem;">
                <form method="POST" action="/products/update?id={{$product->id}}" class="card-body p-5 text-center">
                    @csrf 
                    <div class="mb-md-5 mt-md-4 pb-5">
      
                        <h2 class="fw-bold mb-2 text-uppercase">Modify product</h2>
                        <p class="text-white-50 mb-5"></p>
      
                        <div class="form-outline form-white mb-4">
                            <input type="text" id="typeEmailX" name="name" class="form-control form-control-lg" value="{{$product->name}}" />
                            <label class="form-label" for="typeEmailX">Name</label>
                        </div>
      
                        <div class="form-outline form-white mb-4">
                            <input type="text" id="typePasswordX" name="quantity" class="form-control form-control-lg" value="{{$product->quantity}}" />
                            <label class="form-label" for="typePasswordX">Quantity</label>
                        </div>

                        <div class="form-outline form-white mb-4">
                            <textarea type="text" id="typePasswordX" name="description" class="form-control form-control-lg">{{$product->description}}</textarea>
                            <label class="form-label" for="typePasswordX">Description</label>
                        </div>

                        <div class="form-outline form-white mb-4">
                            <input type="text" id="typePasswordX" value="{{$product->price}}" name="price" class="form-control form-control-lg" />
                            <label class="form-label" for="typePasswordX">Price</label>
                        </div>


                        <div class="form-outline form-white mb-4">
                            <select id="Category" class="select" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                              </select>
                            <label class="form-label" for="Category">Category</label>
                        </div>

                        
          
                        <button class="btn btn-outline-light btn-lg px-5" type="submit">Update product</button>
      
                    </div>  
      
                </form>
              </div>
            </div>
          </div>
        </div>
    </section>
</div>

@endsection