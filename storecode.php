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



// -----------------NavBar code --------------------------------
<?php
  use App\Http\Controllers\ProductController;
  $total = 0;
  if(Session::has('user')){
   $total = ProductController::CartItem();
  }
?>

@if(!Session::has('adminUser'))
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed"  data-bs-toggle="collapse" data-bs-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">Cakeshop</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home</a></li>
          <li class=""><a href="/myorders">Orders</a></li>
        </ul>
        <form class="navbar-form navbar-left" action="/search" method="GET">
              @csrf
          <div class="form-group">
            <input type="text" class="form-control" name="query" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
        <ul class="nav navbar-nav navbar-right">
        @if(Session::has('user'))
          <li><a href="/cartlist">Cart({{$total}})</a></li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{Session::get('user')['name']}}
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/logout">Logout</a></li>
            </ul>
         </li>
        @else
          <li><a href="/cartlist">Cart({{$total}})</a></li>
          <li><a href="/login">Login</a></li>
          <li><a href="/register">Register</a></li>
        @endif
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
@else 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin Panel</title>

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
</head>

<body class="hold-transition fixed skin-blue sidebar-mini">

	<div class="wrapper">

		<header class="main-header">
			<a href="" class="logo">
				<span class="logo-lg">Cakeshop</span>
			</a>
			<nav class="navbar navbar-static-top">
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				<span style="float:left;line-height:50px;color:#fff;padding-left:15px;font-size:18px;">Admin Panel</span>
    <!-- Top Bar ... User Inforamtion .. Login/Log out Area -->
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
            <span class="hidden-xs">{{Session::get('adminUser')['name']}}</span>
					</ul>
				</div>

			</nav>
      
		</header>

  		<?php $cur_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); ?>
<!-- Side Bar to Manage Shop Activities -->
  		<aside class="main-sidebar">
    		<section class="sidebar">
      			<ul class="sidebar-menu">
			        <li class="treeview <?php if($cur_page == 'index.php') {echo 'active';} ?>">
			          <a href="/admin/dashboard">
			            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
			          </a>
			        </li>

              <li class="treeview <?php if( ($cur_page == 'product.php') || ($cur_page == 'product-add.php') || ($cur_page == 'product-edit.php') ) {echo 'active';} ?>">
                  <a href="/admin/products">
                      <i class="fa fa-shopping-bag"></i> <span>Product Management</span>
                  </a>
              </li>

              <li class="treeview <?php if( ($cur_page == 'order.php') ) {echo 'active';} ?>">
                  <a href="/admin/orders">
                      <i class="fa fa-sticky-note"></i> <span>Order Management</span>
                  </a>
              </li>

              <li class="treeview <?php if( ($cur_page == 'customer.php') || ($cur_page == 'customer-add.php') || ($cur_page == 'customer-edit.php') ) {echo 'active';} ?>">
			          <a href="/admin/customers">
			            <i class="fa fa-user-plus"></i> <span>Registered Customers</span>
			          </a>
			        </li>

              <li class="treeview ">
						    <a href="/logout">Logout  </a>
			        </li>
      			</ul>
    		</section>
  		</aside>
  		<div class="content-wrapper">

 @endif                     


 

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>



// ------------------Bootstrap Nav Bar------------------------------------------------
<style>
  .navbar-toggler {
    width: 20px;
    height: 20px;
    position: relative;
    transition: .5s ease-in-out;
  }

  .navbar-toggler,
  .navbar-toggler:focus,
  .navbar-toggler:active,
  .navbar-toggler-icon:focus {
    outline: none;
    box-shadow: none;
    border:0;
  }

  .navbar-toggler span {
    margin: 0;
    padding: 0;
  }

  .toggler-icon {
    display:block;
    position:absolute;
    height:3px;
    width:100%;
    background:#d3531a;
    border-radius:1px;
    opacity:1;
    left:0;
    transform: rotate(0deg);
    transition: .25s ease-in-out;
  }

  .middle-bar {
    margin-top: 0px;
  }

  /* when navigation is clicked */

  .navbar-toggler .top-bar {
    margin-top: 0px;
    transform: rotate(135deg);
  }

  .navbar-toggler .middle-bar {
    opacity:0;
    filter: alpha(opacity=0);
  }

  .navbar-toggler .bottom-bar {
    margin-top: 0px;
    transform: rotate(-135deg);
  }

  /* state when the navbar is collapsed */
  .navbar-toggler.collapsed .top-bar {
    margin-top: -20px;
    transform: rotate(0deg);
  }

  .navbar-toggler.collapsed .middle-bar {
    opacity: 1;
    filter: alpha(opacity=100);

  }

  .navbar-toggler.collapsed .bottom-bar {
    margin-top: 20px;
    transform: rotate(0deg);
  }

  /* Color of 3 lines  */
  .navbar-toggler.collapsed .toggler-icon{
    /* background: linear-gradient( 263deg,rgba(252,74,74,1) 0%,rgba(0,212,255,1) 100% ); */
  }
  

</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler collapsed d-flex d-lg-none flex-column justify-content-around" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="toggler-icon top-bar"></span>
    <span class="toggler-icon middle-bar"></span>
    <span class="toggler-icon bottom-bar"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>