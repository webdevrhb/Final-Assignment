@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="display-4 mb-4 text-center">Contact Us</h1>
        <form action="" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="name" class="form-label">Name</label>
                <input class="form-control" id="name" name="name" type="text" required>
            </div>
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input class="form-control" id="email" name="email" type="email" required>
            </div>
            <div class="form-group mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>
            <button class="btn btn-primary btn-lg" type="submit">Submit</button>
        </form>
    </div>
@endsection
