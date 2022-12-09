@extends('layouts.mainlayout')

@section('content')
<div class="card bg-dark text-white">
    <img src="{{URL::asset('2.jpg')}}" class="card-img-top img-thumbnail" style="width: 20rem; height: 20rem" alt="Fissure in Sandstone"/>
    <div class="card-body">
      <h5 class="card-title">{{$product->name}}</h5>
      <p class="card-text">{{$product->description}}</p>
      <p class="card-text">Price - {{$product->price}}$</p>
    </div>

    @can('modify', $product)
        <a href="/products/update?id={{$product->id}}" class="btn btn-dark">Modify</a>
        <form action="/products/delete?id={{$product->id}}" method="POST">
            @csrf
            <button class="btn btn-dark" type="submit">Delete</button>
        </form>
    @endcan
  </div>
@endsection