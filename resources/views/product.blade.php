@extends('master')
@section('content')
<div class="custom-product">
   <div id="myCarousel" class="carousel slide " data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner custom-carousel-inner">
            @foreach ($products as $item)
                <div class="item {{$item['id']==20?'active':''}}">
                    
                    <a href="detail/{{$item['id']}}">
                        <img class="slider-img" src="{{ asset('images/products/'.$item->gallery) }}" >
                        <div class="carousel-caption slider-text">
                            <h3>{{$item['name']}}</h3>
                            <p>{{$item['description']}}</p>
                        </div>
                    </a>
                    
                </div>
            @endforeach

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="trending-wrapper">
        <h2 class="title">Featured Products</h2>
        <div class="small-container">
            <div class="row">
                @foreach ($products as $item)
                    <div class="col-4">
                        <a href="detail/{{$item['id']}}">
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
</div>
@endsection