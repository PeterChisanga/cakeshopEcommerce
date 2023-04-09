<div class="trending-wrapper">
    <p>you have ordered the following items from Cakeshop.com for any queries call +212 111 222 333 </p>
    <?php $totalAmount = 0; ?>
    @foreach($orders as $item)
    <?php $totalAmount += $item->cart_price; ?>
    <div class="row">
        <div class="col-sm-3">
            <div class="">
                <h2>{{$item->name}}</h2>
                <h4>Price : {{$item->cart_price}} Dh</h4>
                <h4>Quantity {{$item->quantity}}</h4>
                <h4>Weight {{$item->weight}} Kg</h4>
                <h4>Description : {{$item->description}}</h4>
                <h4>Payment Status : {{$item->payment_status}}</h4>
                <h4>Payment Method : {{$item->payment_method}}</h4>
            </div>
        </div>
    </div>
    @endforeach
    <h2>Total Price : {{$totalAmount}} Dh</h2>
</div>