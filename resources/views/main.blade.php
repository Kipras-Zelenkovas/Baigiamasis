@extends('layouts.mainlayout')


@section('content')

<div class="container-fuild m-4">
    <div class="row gap-2">
  @foreach ($products as $product)

  <div class="card mb-3 bg-dark text-white" style="max-width: 540px;">
    <div class="row g-2">
      <div class="col-md-4">
        <img
          src="{{ URL::asset('download.jpg') }}"
          alt="Trendy Pants and Shoes"
          class="img-fluid rounded-start"
        />
      </div>
      <div class="col-md-8">  
        <div class="card-body">
          <h5 class="card-title">{{$product->name}}</h5>
          <p class="card-text text-truncate">
            {{$product->description}}
          </p>
          <p class="card-text">
            <small class="text-muted">Price - {{$product->price}}</small>
          </p>
          <p class="card-text">
            <a href="/products/product?id={{$product->id}}" class="text-muted">Check</a>
          </p>
        </div>
      </div>
    </div>
  </div>
  @endforeach 
</div>
</div>


<nav aria-label="Page navigation example' ">
    <ul class="pagination">
        @if ($page > 1)
        <li class="page-item bg-dark"><a class="page-link" href="/products?page={{$page-1}}">Previous</a></li>
        @endif
        <li class="page-item bg-dark"><a class="page-link" href="/products?page={{$page+1}}">Next</a></li>
    </ul>
  </nav>

@endsection