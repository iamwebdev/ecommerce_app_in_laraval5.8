@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12">
        <h1 style="text-align: center;">Products List</h1>
        <div class="row">
            @if (isset($products))
                @foreach($products as $product)   
                    <div class="col-md-4 mt-5">
                        <div class="card" style="width: 18rem;">
                          <img height="200" width="200" class="card-img-top" src="{{ asset($product->image) }}" alt="Card image cap">
                          <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">Price: {{ $product->price }}</p>
                            <a href="/add-to-cart/{{ $product->id }}" class="btn btn-primary">Add to Cart</a>
                          </div>
                        </div>
                    </div>
                @endforeach    
            @endif
        </div>
    </div>    
</div>
@endsection
