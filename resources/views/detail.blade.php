@extends('master')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-6">
        <img class="detail-img" src="{{$product['gallery']}}" alt="">
    </div>
    <div class="col-sm-6">
        <a href="/">Go Back</a>
        <h2>Name : {{$product['name']}}</h2>
        <h3>Price : {{$product['price']}} Dh</h3>
        <h4 >Details : {{$product['description']}}</h4>
        <br>
        <form action="/add_to_cart" method="POST">
           @csrf
            <input type="hidden" name="product_id" value="{{$product['id']}}">
            <button class="btn btn-primary ">Add To Cart</button>
        </form>
        <br>
        <button class="btn btn-success ">Buy Now</button>
        <br>
    </div>
  </div>
</div>
@endsection