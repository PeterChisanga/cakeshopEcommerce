<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_users');
    }
};


// ---------------adminuser Model---------------
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class AdminUser extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
// -------------------mails------------------------------
<?php
 
namespace App\Mail;
 
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
 
class OrderConfirmed extends Mailable
{
    use Queueable, SerializesModels;
 
    /**
     * Create a new message instance.
     */
    public function __construct(
        public Order $order,
    ) {}
 
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.orders.confirmed',
        );
    }
}

// ---------details page------------------------------------------------
<div class="container">
  <div class="row">
    <div class="col-sm-6">
        <img class="detail-img" src="{{ asset('images/products/'.$product->gallery) }}" alt="">
    </div>
  <div class="col-sm-6">
    <a href="/">Go Back</a>
    <h2> {{$product['name']}}</h2>
    <h3>Price : <span id="price">{{$product['price']}}</span> Dh</h3>
    <h4>Details : {{$product['description']}}</h4>
    <br>
    <form action="/add_to_cart" method="POST" onsubmit="calculatePrice()">
        @csrf
        <label for="">Poids</label>
        <select id="weight" name="weight" onchange="calculatePrice()">
            <option value="2">2 Kg</option>
            <option value="1">1 Kg</option>
            <option value="3">3 Kg</option>
            <option value="4">Large 4Kg</option>
        </select>
        <label for="">Qty</label>
        <input type="number" id="quantity" name="quantity" value="1" onchange="calculatePrice()" />
        <br>
        <input type="hidden" name="product_id" value="{{$product['id']}}">
        <input type="hidden" name="price" id="price_input" value="{{$product['price']}}">
        <button class="btn btn-primary ">Add To Cart</button>
        <button class="btn btn-success " style="margin-left:10px;">Buy Now</button>
    </form>
  </div>
  </div>
</div>



// ------------Cartlist--------------------------------

<!-- <div class="custom-product">
    <div class="trending-wrapper">
        <h3>Total : {{$total}} Dh</h3>
        @if ($total > 0)
        <a class="btn btn-primary" href="/">Add Another Product</a> <br> <br>
        <a class="btn btn-success" href="ordernow">Order Now</a> <br> <br>
        @else
        <a class="btn btn-primary" href="/">Add Product</a> <br> <br>
        @endif

        @foreach($products as $item)
        <div class=" row searched-item cart-list-devider">
            <div class="col-sm-3">
                <a href="detail/{{$item->id}}">
                    <img class="trending-image" style="width:150px; height:auto;" src="{{ asset('images/products/'.$item->gallery) }}">
                </a>
            </div>
            <div class="col-sm-3">
                <div class="">
                    <h2>{{$item->name}}</h2>
                    <h3>Price {{$item->cart_price}} Dh</h3>
                    <h3>Weight {{$item->weight}} Kg</h3>
                    <h3>Qty {{$item->quantity}} </h3>
                    <h5>{{$item->description}}</h5>
                </div>
            </div>
            <div class="col-sm-3">
                <a href="/removecart/{{$item->cart_id}}" class="btn btn-warning"> Remove From Cart</a>
            </div>
        </div>
        @endforeach
        @if($total > 0)
        <a class="btn btn-success" href="ordernow">Order Now</a> <br> <br>
        @endif
    </div>
</div> -->


// -----------myrders page ----------------------------------------------------

@extends('master')
@section("content")
<style>
    .custom-cartlist-container{
        background: radial-gradient(#fff, #ffd6d6);
        width: 100%;
        padding: 40px 100px;
    }
    .img-fluid{
    max-width: 100%;
    height: auto;
}
</style>
<div class="container custom-cartlist-container">
    <div class="col-sm-10">
        <h4>My Orders</h4>
        <?php $totalAmount = 0; $item = 0; ?>
        @foreach($orders as $item)
        <?php $totalAmount += $item->cart_price; ?>
        <div class=" row searched-item cart-list-devider">
            <div class="col-sm-3">
                <a href="detail/{{$item->id}}">
                    <img class="trending-image" src="{{ asset('images/products/'.$item->gallery) }}" style="width:100%; height:auto;">
                </a>
            </div>
            <div class="col-sm-3">
                <div class="">
                    <h2>{{$item->name}}</h2>
                    <h4>Price {{$item->cart_price}} Dh</h4>
                    <h4>Quantity {{$item->quantity}}</h4>
                    <h4>Weight {{$item->weight}} Kg</h4>
                    <h5>{{$item->description}}</h5>
                    
                </div>
            </div>
        </div>
        @endforeach
        @if($item != null)
            <h4>Total Price : {{$totalAmount}} Dh</h4>
            <h4>Delivery Status : {{$item->status}}</h4>
            <h4>Address : {{$item->address}}</h4>
            <h4>Payment Status : {{$item->payment_status}}</h4>
            <h4>Payment Method : {{$item->payment_method}}</h4>
        @else
        <h4>You do not have any orders</h4>
        @endif
    </div>
</div>
@endsection  
// ---------------------register page --------------------
@extends('master')
@section('content')
<div class="container custom-login">
    <div class="col-sm-4 col-sm-offset-4">
        <form action="/register" method="POST">
                @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="name" class="form-control" id="name" name="name" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-success">Register</button>
        </form>
    </div>
</div>
@endsection


  @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif

  @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif

  @if($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif