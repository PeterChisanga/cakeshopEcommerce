@extends('master')
@section('content')
<style>

@media screen and (max-width: 767px) {
    .my-4{
        padding-bottom:100px;
    }
    .product-cell {
        display: block;
        margin-bottom: 2rem;
    }
    .product-cell img {
        width: 90%;
        margin: 0 auto;
        display: block;
    }
    .product-details {
        text-align: left;
        margin-top: 1rem;
        width: 80%;
        margin: 0 auto;
    }
    .product-details h6 {
        font-size: 16px;
    }
    .product-details p {
        font-size: 13px;
    } 

    .order-details h3{
        font-size: 16px;
    }
}

@media screen and (min-width: 768px) {
    .my-4{
    padding-bottom:400px;
    }
    .product-row {
    display: table;
    width: 100%;
    margin-bottom:30px;
    }
    .product-cell {
    display: table-cell;
    width: 55%;
    vertical-align: middle;
    }
    .product-cell img {
    width: 100%;
    }
    .product-details {
    display: table-cell;
    width: 40%;
    margin-left: 2rem;
    }
    .product-details h6 {
    font-size: 30px;
    }
    .product-details p {
    font-size: 20px;
    }
}

.d-md-table-header {
    display: table-header-group !important;
}

.order-summary {
    margin-top: 2rem;
    text-align: left;
}

.order-summary h3 {
    font-size: 1.25rem;
}

.order-summary p {
    font-size: 1rem;
}

@media screen and (max-width: 767px) {
    .order-summary p {
        font-size: 0.9rem;
    }
}

@media screen and (max-width: 575px) {
    .order-summary p {
        font-size: 0.85rem;
    }
}

</style>
<div class="container my-4">
    <h4 class="text-center">My Orders</h4>
    <div class="row">
        <div class="col-md-10 mx-auto">
            <?php $totalAmount = 0; ?>
            @if(count($orders) > 0)
                @foreach($orders as $item)
                    <?php $totalAmount += $item->cart_price; ?>
                    <div class="row product-row">
                        <div class="col-3 col-md-3 product-cell">
                            <a href="detail/{{$item->id}}">
                                <img class="trending-image" src="{{ asset('images/products/'.$item->gallery) }}">
                            </a>
                        </div>
                        <div class="col-3 col-md-9 product-details">
                            <h6>{{$item->name}}</h6>
                            <p><strong>Price:</strong> {{$item->cart_price}} Dh</p>
                            <p><strong>Quantity:</strong> {{$item->quantity}}</p>
                            <p><strong>Weight:</strong> {{$item->weight}} Kg</p>
                            <p><strong>Description:</strong> {{$item->description}}</p>
                        </div>
                    </div>
                @endforeach
            <div class="text-left order-details">
                <h3>Total Price : {{$totalAmount}} Dh</h3>
                <h3>Delivery Status : {{$orders[0]->status}}</h3>
                <h3>Address : {{$orders[0]->address}}</h3>
                <h3>Payment Status : {{$orders[0]->payment_status}}</h3>
                <h3>Payment Method : {{$orders[0]->payment_method}}</h3>
            </div>
            @else
            <div class="text-center">
                <h5>You do not have any orders</h5>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
