@extends('layouts.admin')

@section('content')
    @include('partials._alerts')
    <br>

    <h2 align="center">Rentals</h2>
    {{-- <a class="btn btn-outline-success mb-3" href="{{ route('admin.rentals.create') }}">Add Rental</a> --}}
    <table class="table-bordered table">
        <thead>
            <tr>
                <th>Rental ID</th>
                <th>Customer Name</th>
                <th>Car Details (Name, Brand)</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Total Cost</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentals as $rental)
                <tr>
                    <td>{{ $rental->id }}</td>
                    <td>{{ $rental->user->name }}</td>
                    <td>{{ $rental->car->name }} ({{ $rental->car->brand }})</td>
                    <td>{{ $rental->start_date }}</td>
                    <td>{{ $rental->end_date }}</td>
                    <td>{{ $rental->total_cost }}</td>
                    <td>{{ $rental->status }}</td>
                    <td>
                        <a class="btn btn-outline-warning btn-sm" href="{{ route('admin.rentals.edit', $rental->id) }}">Edit</a>
                        <form style="display:inline;" action="{{ route('admin.rentals.destroy', $rental->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $rentals->links() }}

    <hr>

    <div class="mt-4">
        <table class="table-bordered table">
            <thead>
                <tr>
                    <th>Brand</th>
                    <th>Car Type</th>
                    <th>Daily Rent Price</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cars as $car)
                    <tr>
                        <td>{{ $car->brand }}</td>
                        <td>{{ $car->car_type }}</td>
                        <td>${{ $car->daily_rent_price }}</td>
                        <td><img class="img-thumbnail" src="{{ asset($car->image) }}" alt="{{ $car->brand }} - {{ $car->car_type }}" style="height: 100px; width: 120px;"></td>
                        
                        
                        <td>
                            <a class="btn btn-outline-success" href="{{ route('admin.rentals.create', ['id' => $car->id]) }}">Make New Rental</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
