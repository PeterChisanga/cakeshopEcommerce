@extends('master')
@section('content')
<div class="container custom-login">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    <p>{{ session()->get('error') }}</p>
                </div>
            @endif
            <h3>Admin Login</h3>
            <form action="/admin/login" method="POST">
             @csrf
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                
                <button type="submit" class="btn btn-success">Login</button>
            </form>
            <br>
            <p>Don't have an account? <a href="/admin/create-account">Register</a></p>
        </div>
    </div>
</div>
@endsection