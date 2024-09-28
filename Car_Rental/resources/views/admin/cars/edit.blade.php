@extends('layouts.admin')

@section('content')
    <h2>Edit Car</h2>
    <hr>
    <form action="{{ route('admin.cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group mb-2">
            <label class="form-label" for="name">Car Name</label>
            <input class="form-control" id="name" name="name" type="text" value="{{ $car->name }}" required>
        </div>

        <div class="form-group mb-2">
            <label class="form-label" for="brand">Brand</label>
            <input class="form-control" id="brand" name="brand" type="text" value="{{ $car->brand }}" required>
        </div>

        <div class="form-group mb-2">
            <label class="form-label" for="model">Model</label>
            <input class="form-control" id="model" name="model" type="text" value="{{ $car->model }}" required>
        </div>

        <div class="form-group mb-2">
            <label class="form-label" for="year">Year of Manufacture</label>
            <input class="form-control" id="year" name="year" type="number" value="{{ $car->year }}" required>
        </div>

        <div class="form-group mb-2">
            <label class="form-label" for="car_type">Car Type</label>
            <input class="form-control" id="car_type" name="car_type" type="text" value="{{ $car->car_type }}" required>
        </div>

        <div class="form-group mb-2">
            <label class="form-label" for="daily_rent_price">Daily Rent Price</label>
            <input class="form-control" id="daily_rent_price" name="daily_rent_price" type="number" value="{{ $car->daily_rent_price }}" required>
        </div>

        <div class="form-group mb-2">
            <label class="form-label" for="availability">Availability</label>
            <select class="form-control" id="availability" name="availability" required>
                <option value="1" {{ $car->availability == 1 ? 'selected' : '' }}>Available</option>
                <option value="0" {{ $car->availability == 0 ? 'selected' : '' }}>Not Available</option>
            </select>
        </div>

        <div class="mb-2">
            <label class="form-label" for="formFile">Select Car Image</label>
            <input class="form-control" id="image" name="image" type="file">
        </div>

        <button class="btn btn-outline-success" type="submit">Update Car</button>
    </form>
@endsection
