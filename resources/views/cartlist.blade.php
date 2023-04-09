@extends('master')
@section("content")


<style>
.img-fluid{
    max-width: 100%;
    height: auto;
}
.custom-cartlist-container{
       background: radial-gradient(#fff, #ffd6d6);
        width: 100%;
        padding: 40px 100px;
}

.justify-content-between{
    justify-content:space-between;
}
@media (max-width: 767px) {
    .col-md-6 {
      width: 100%;
    }
     .custom-cartlist-container{
      padding: 10px 30px;
     }
/* 
      .justify-content-between{
        justify-content:space-between;
    } */
  }
   @media (min-width: 768px) {
    .col-md-6 {
      display: inline-block;
      width: 50%;
      vertical-align: top;
    }
   
  }

  @media (max-width: 991px) {
  .justify-content-between {
    justify-content: space-between;
  }
  .custom-div-buttom{
    margin-right: 40px;
  }
}
</style>

<div class="container custom-cartlist-container">
  <div class="row">
    <div class="col-md-8 mx-auto">
      <div class="custom-product">
        <h3>Total: {{$total}} Dh</h3>
        <div class="row justify-content-between">
            <div class="col-12 col-md-auto mb-3 mb-md-0 custom-div-buttom">
                @if ($total > 0)
                <a class="btn btn-primary " href="/">Add Another Product</a>
                @else
                <a class="btn btn-primary" href="/">Add Product</a>
                @endif
            </div>
            @if($total > 0)
            <div class="col-12 col-md-auto">
                <a class="btn btn-success" href="ordernow">Order Now</a>
            </div>
            @endif
        </div>
        <hr>
        @foreach($products as $item)
        <div class="row searched-item cart-list-devider">
          <div class="col-12 col-md-3">
            <a href="detail/{{$item->id}}">
              <img class="trending-image img-fluid" src="{{ asset('images/products/'.$item->gallery) }}" alt="{{$item->name}}">
            </a>
          </div>
          <div class="col-12 col-md-6">
            <h4>{{$item->name}}</h4>
            <p>Price: {{$item->cart_price}} Dh</p>
            <p>Weight: {{$item->weight}} Kg</p>
            <p>Quantity: {{$item->quantity}}</p>
            <p>{{$item->description}}</p>
          </div>
          <div class="col-12 col-md-3 d-flex align-items-center justify-content-center justify-content-md-end">
            <a href="/removecart/{{$item->cart_id}}" class="btn btn-warning">Remove From Cart</a>
          </div>
        </div>
        @endforeach
        <hr>
        <div class="row justify-content-center">
          @if($total > 0)
          <div class="col-12 col-md-auto">
            <a class="btn btn-success" href="ordernow">Order Now</a>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

@endsection 