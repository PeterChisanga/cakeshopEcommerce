@extends('master')
@section('content')
<div class="container custom-login">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <form action="/password/email" method="POST">
             @csrf
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
                @if($errors->any('email'))
                    <span class="text-danger">{{$errors->first('email')}}</span>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <button type="submit" class="btn btn-success">Send Password Reset Link</button>
            </form>
        </div>
    </div>
</div>
@endsection