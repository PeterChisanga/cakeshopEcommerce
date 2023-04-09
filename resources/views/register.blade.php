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
