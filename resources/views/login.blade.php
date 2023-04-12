@extends('master')
@section('content')

<div class="container custom-login">
    <div class="col-sm-4 col-sm-offset-4">
      @if ($errors != null)
            @foreach ($errors as $error)
            <div class="alert alert-danger">
                {{ $error }}
            </div>
            @endforeach
        @endif
        <form action="/login" method="POST">
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
        <p> <a href="/password/reset">Forgot Password?</a></p>
        <p>Don"t have an account? <a href="/register">Register</a></p>
    </div>
</div>
@endsection