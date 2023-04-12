<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake Shop</title>
        <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


    <!-- Optional theme -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    


    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/datepicker3.css') }}">
	<link rel="stylesheet" href="{{ asset('css/all.css') }}">
	<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">
	<link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/_all-skins.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/on-off-switch.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css/summernote.css') }}">
	<link rel="stylesheet" href="{{ asset('style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/footer.css') }}">



</head>
<body>
    {{View::make('header')}}
    @yield('content')
    {{View::make('footer')}}


</body>
<style>

    .navbar-default {
    margin-bottom: 0px;
            background-color: rgb(205, 168, 142);




    }
    .custom-login{
        height: 500px;
        padding-top: 100px;
        margin-bottom:300px;
    }

    @media (min-width: 992px) {
        .custom-carousel-inner {
            height: 65vh;
            overflow: hidden;
        }
        
        .custom-carousel-inner .item .carousel-caption {
            bottom: 70%;
            transform: translateY(-70%);
        }
    }

   .slider-img{
        width: 100%;
        height: 50%;
        object-fit: cover;
    }

    .slider-text{
        background-color:#ee88e0d4 !important;
    }

    .trending-img{
        height: 100px;
    }
    .trending-item{
        float: left;
        width: 20%;
    }
    .trending-wrapper{
        background: radial-gradient(#fff, #ffd6d6);

    }
    .detail-img{
        height: 200px;
    }
    .search-box{
        width:500px !important;
    }
    .cart-list-devider{
        border-bottom: 1px solid #ccc;
        margin-bottom:20px;
        padding-bottom:20px;
    }

    /* ---------------welcome page--------------- */

    .small-container {
        width: 93%;
        /* margin: 0 40px 0 120px; */
        margin: 0 auto;
        padding-left: 25px;
        padding-right: 25px;
    }

    .row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        justify-content: flex-around;
    }
   
    .col-4 {
        flex-basis: 20%;
        padding: 3px;
        min-width: 200px;
        margin:0 15px 50px 15px;
        transition: transform 0.5s;
        box-shadow: 3px 3px 3px 3px rgba(0,0,0,.2);
        height: 370px;
        overflow: hidden;
    }

    .col-4 img {
        width: 100%;
        height: 50%;
        object-fit: cover;
    }

    .title {
    text-align: center;
    margin: 0 auto 80px;
    position: relative;
    line-height: 60px;
    color: #555;
    }
    
    .title::after {
    content: " ";
    background: #ff523b;
    width: 80px;
    height: 5px;
    border-radius: 5px;
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    }

    h4 {
    color: #555;
    font-weight: normal;
    }

    h3,h4,h5,.rating{
    margin-left: 30px;
    }

    .col-4 p {
    font-size: 14px;
    }
    .rating .fa {
    color: #ff523b;
    }

    .col-4:hover {
    transform: translateY(-5px);
    }

    /* Small screens */
    @media only screen and (max-width: 576px) {
        .small-container {
            width: 80%;
            margin: 0 auto;
            padding-left: 10px;
            padding-right: 10px;
        }

        .col-4 {
            flex-basis: 100%;
            margin: 0 0 30px 0;
            min-width: 0;
        }
    }

    /* Medium screens */
    @media only screen and (min-width: 577px) and (max-width: 991px) {
        .small-container {
            width: 95%;
            margin: 0 auto;
            padding-left: 5px;
            padding-right: 5px;
        }
        .row {
            justify-content: center;
        }

        .col-4 {
            flex-basis: 40%;
            margin: 0 15px 30px 15px;
            min-width: 0;
        }
    }

    /* Large screens */
    @media only screen and (min-width: 992px) {
        .row {
            justify-content: space-between;
        }

        .col-4 {
            flex-basis: 30%;
            margin: 0 15px 50px 15px;
            min-width: 200px;
        }
    }

    /* --------------Details page-------------- */
    



</style>
</html>