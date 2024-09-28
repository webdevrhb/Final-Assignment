@extends('layouts.auth')
@section('content')
@include('partials._alerts')
    <br>
    <br>
    <div class="card" style="max-width: 500px; margin: auto; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
      
        <div class="card-body" style="padding: 30px;">
        <div class="card-header text-center">
            <h2 align="center">Register</h4>
        </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="name" style="font-weight: bold;">Name</label>
                    <input class="form-control" id="name" name="name" type="text" value="{{ old('name') }}" required autofocus style="border: 1px solid #007bff; border-radius: 5px;">
                    @error('name')
                        <div class="alert alert-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email" style="font-weight: bold;">Email Address</label>
                    <input class="form-control" id="email" name="email" type="email" value="{{ old('email') }}" required style="border: 1px solid #007bff; border-radius: 5px;">
                    @error('email')
                        <div class="alert alert-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone" style="font-weight: bold;">Phone Number</label>
                    <input class="form-control" id="phone" name="phone" type="text" value="{{ old('phone') }}" required style="border: 1px solid #007bff; border-radius: 5px;">
                    @error('phone')
                        <div class="alert alert-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address" style="font-weight: bold;">Address</label>
                    <input class="form-control" id="address" name="address" type="text" value="{{ old('address') }}" required style="border: 1px solid #007bff; border-radius: 5px;">
                    @error('address')
                        <div class="alert alert-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password" style="font-weight: bold;">Password</label>
                    <input class="form-control" id="password" name="password" type="password" required style="border: 1px solid #007bff; border-radius: 5px;">
                </div>
                <div class="form-group">
                    <label for="password-confirm" style="font-weight: bold;">Confirm Password</label>
                    <input class="form-control" id="password-confirm" name="password_confirmation" type="password" required style="border: 1px solid #007bff; border-radius: 5px;">
                    @error('password')
                        <div class="alert alert-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-success btn-block mt-2" type="submit">Register</button>
                <a class="btn btn-outline-primary btn-block mt-2" href="/login">Go to Login</a>
            </form>
        </div>
    </div>
@endsection
