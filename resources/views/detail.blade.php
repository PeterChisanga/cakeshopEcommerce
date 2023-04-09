@extends('master')
@section('content')
<style>
 .custom-details-container {
        background: radial-gradient(#fff, #ffd6d6);
        width: 100%;
        padding: 40px 100px;
  }
  .img-fluid {
    max-width: 100%;
    height: auto;
  }

  .rating-details .fa{
    color: red;
  }

   @media (max-width: 767px) {
    .col-md-6 {
      width: 100%;
    }
     .custom-details-container{
      padding: 10px 30px;
     }
  }
   @media (min-width: 768px) {
    .col-md-6 {
      display: inline-block;
      width: 50%;
      vertical-align: top;
    }
  }
</style>

<div class="container mb-20 custom-details-container">
  <div class="row">
    <div class="col-md-6">
      <img class="img-fluid" src="{{ asset('images/products/'.$product->gallery) }}" alt="{{$product['name']}}">
    </div>
    <div class="col-md-6">
      
      <h2 class="mb-3">{{$product['name']}}</h2>
      <div class="rating-details"> 
       <i class="fa fa-star" ></i>
          <i class="fa fa-star" ></i>
          <i class="fa fa-star" ></i>
          <i class="fa fa-star-half" ></i>
          <i class="fa fa-star-o" ></i>
      </div>
      <p class="lead mb-4">Price: <span id="price">{{$product['price']}}</span> Dh</p>
      <p>{{$product['description']}}</p>
      <form action="/add_to_cart" method="POST" class="" onsubmit="calculatePrice()">
        @csrf
        <div class="form-group">
          <label for="weight">Weight</label>
          <select id="weight" name="weight" class="form-control " onchange="calculatePrice()">
            <option value="2">2 Kg</option>
            <option value="1">1 Kg</option>
            <option value="3">3 Kg</option>
            <option value="4">Large 4Kg</option>
          </select>
        </div>
        <div class="form-group">
          <label for="quantity">Quantity</label>
          <input type="number" id="quantity" name="quantity" class="form-control" value="1" onchange="calculatePrice()" />
        </div>
        <input type="hidden" name="product_id" value="{{$product['id']}}">
        <input type="hidden" name="price" id="price_input" value="{{$product['price']}}">
        <button class="btn btn-primary">Add To Cart</button>
        <button class="btn btn-success ml-4">Buy Now</button>
      </form>
    </div>
  </div>
</div>


<div class="trending-wrapper">
        <h2 class="title">Similar Products</h2>
        <div class="small-container">
            <div class="row">
                @foreach ($products as $item)
                    <div class="col-4">
                        <a href="/detail/{{$item['id']}}">
                            <img src="{{ asset('images/products/'.$item->gallery) }}" alt="">
                            <h3>{{$item['name']}}</h3>
                            <h5>{{$item['description']}}</h5>
                            <div class="rating">
                                <i class="fa fa-star" ></i>
                                <i class="fa fa-star" ></i>
                                <i class="fa fa-star" ></i>
                                <i class="fa fa-star-half" ></i>
                                <i class="fa fa-star-o" ></i>
                            </div>
                            <h4>{{$item['price']}} Dh</h4>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
<script>
    function calculatePrice() {
        var weight = document.getElementById("weight").value;
        var quantity = document.getElementById("quantity").value;
        var pricePerKg = parseFloat({{$product['price']}});
        if (weight === "1") {
            pricePerKg *= .6;
        } else if (weight === "3") {
            pricePerKg *= 1.8;
        } else if (weight === "4") {
            pricePerKg *= 2.2;
        }
        var totalPrice = pricePerKg * quantity;
        document.getElementById("price").innerHTML = totalPrice;
        document.getElementById("price_input").value = totalPrice;
    }
</script>