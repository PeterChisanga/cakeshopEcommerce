@extends('master')
@section('content')
<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <label for="email">Email Address</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <button type="submit">
        {{ __('Send Password Reset Link') }}
    </button>
</form>
@endsection