@extends('layouts.auth')

@section('content')
    <style>
        /* Inline CSS to ensure the background covers the entire viewport */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5; /* Light grey background similar to Google */
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .card {
            width: 360px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            border-radius: 8px;
            background-color: #fff;
        }

        .card-header {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            padding: 20px 0;
        }

        .card-body {
            padding: 20px;
        }

        .form-control {
            height: 40px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .btn-primary {
            width: 100%;
            background-color: #4285f4; /* Google blue */
            border: none;
            padding: 10px 0;
            font-size: 16px;
            color: #fff;
            cursor: pointer;
            border-radius: 4px;
        }

        .btn-primary:hover {
            background-color: #357ae8; /* Darker blue on hover */
        }

        .btn-outline-success {
            width: 100%;
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 10px 0;
            font-size: 16px;
            color: #5f6368; /* Grey text */
            border-radius: 4px;
            text-align: center;
            margin-top: 10px;
            display: block;
        }

        .btn-outline-success:hover {
            background-color: #f5f5f5;
        }

        a {
            text-decoration: none;
            color: inherit;
        }
    </style>

    @include('partials._alerts')
    <div class="card">
        <div class="card-header">Sign In</div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input class="form-control" id="email" name="email" type="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" id="password" name="password" type="password" required>
                </div>
                <button class="btn btn-primary mt-2" type="submit">Sign In</button>
                <a class="btn btn-outline-success mt-2" href="/register">Create Account</a>
            </form>
        </div>
    </div>
@endsection
