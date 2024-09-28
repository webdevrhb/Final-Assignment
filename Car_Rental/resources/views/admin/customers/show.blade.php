@extends('layouts.admin')

@section('content')
    <h3>Customer Rentals</h3>

    <hr>
    <p>Name : {{ $customer->name }}</p>
    <p>Email: {{ $customer->email }}</p>
    <p>Phone: {{ $customer->phone }}</p>
    <p>Address: {{ $customer->address }}</p>
    <hr>

    <h3>Rental History</h3>
    <table class="table-bordered table">
        <thead>
            <tr>
                <th>Car</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Total Cost</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customer->rentals as $rental)
                <tr>
                    <td>{{ $rental->car->name }}</td>
                    <td>{{ $rental->start_date }}</td>
                    <td>{{ $rental->end_date }}</td>
                    <td>{{ $rental->total_cost }}</td>
                    <td>
                        @if ($rental->status == 'Pending')
                            <span class="badge bg-primary">Pending</span>
                        @elseif ($rental->status == 'Ongoing')
                            <span class="badge bg-warning">Ongoing</span>
                        @elseif ($rental->status == 'Completed')
                            <span class="badge bg-success">Completed</span>
                        @elseif ($rental->status == 'Canceled')
                            <span class="badge bg-danger">Canceled</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
