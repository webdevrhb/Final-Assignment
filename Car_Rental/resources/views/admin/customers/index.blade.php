@extends('layouts.admin')

@section('content')
    @include('partials._alerts')
    <h2>Customers</h2>
    <a class="btn btn-outline-success mb-3" href="{{ route('admin.customers.create') }}">Add Customer</a>
    <table class="table-bordered table">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>
                        <a class="btn btn-outline-warning btn-sm" href="{{ route('admin.customers.edit', $customer->id) }}">Edit</a>
                        <form style="display:inline;" action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm" type="submit">Delete</button>
                        </form>
                        <a class="btn btn-outline-info btn-sm" href="{{ route('admin.customers.show', $customer->id) }}">View Rentals</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
