@extends('layouts.admin')

@section('content')
    @include('partials._alerts')
    <h2>Edit Customer</h2>
    <form action="{{ route('admin.customers.update', $customer) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row gap-3">
            <div class="form-group">
                <label for="name">Customer Name</label>
                <input class="form-control" id="name" name="name" type="text" value="{{ $customer->name }}" required>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" id="email" name="email" type="email" value="{{ $customer->email }}" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input class="form-control" id="phone" name="phone" type="text" value="{{ $customer->phone }}" required>
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input class="form-control" id="address" name="address" type="text" value="{{ $customer->address }}" required>
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <button class="btn btn-outline-success mt-2" type="submit">Update Customer</button>
    </form>
@endsection
