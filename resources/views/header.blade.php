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
        <button type="button" class="navbar-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#bs-example-navbar-collapse-1" aria-expanded="false">
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