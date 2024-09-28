@extends('layouts.admin')

@section('content')
    @include('partials._alerts')
    <h2>Cars</h2>
    <a class="btn btn-outline-success mb-3" href="{{ route('admin.cars.create') }}">Add Car</a>

    <table class="table-bordered table">
        <thead>
            <tr>
                <th>SL NO</th>
                <th>Car Name</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Year of Manufacture</th>
                <th>Car Type</th>
                <th>Daily Rent Price</th>
                <th>Availability Status</th>
                <th>Car Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cars as $car)
                <tr>
                    <td>{{ $car->id }}</td>
                    <td>{{ $car->name }}</td>
                    <td>{{ $car->brand }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->year }}</td>
                    <td>{{ $car->car_type }}</td>
                    <td>{{ $car->daily_rent_price }}</td>
                    <td>{{ $car->availability ? 'Available' : 'Not Available' }}</td>
                    <td><img class="img-thumbnail" src="{{ asset($car->image) }}" alt="{{ $car->name }}" style="width: 80px;"></td>
                    <td>
                        <a class="btn btn-outline-warning btn-sm" href="{{ route('admin.cars.edit', $car->id) }}">Edit</a>
                        <form style="display:inline;" action="{{ route('admin.cars.destroy', $car->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
