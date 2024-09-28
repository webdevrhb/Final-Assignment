@extends('layouts.admin')

@section('content')
    @include('partials._alerts')
    <h2>Edit Rental</h2>
    <form action="{{ route('admin.rentals.update', $rental->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row gap-2">
            <div class="form-group">
                <label for="user_id">Customer</label>
                <select class="form-control" id="user_id" name="user_id" required>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $rental->user_id == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="car_id">Car</label>
                <select class="form-control" id="car_id" name="car_id" required>
                    <option value="{{ $car->id }}" selected> ({{ $car->brand }}) : {{ $car->name }}</option>
                </select>
                @error('car_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input class="form-control" id="start_date" name="start_date" type="text" value="{{ $rental->start_date }}" required>
                @error('start_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input class="form-control" id="end_date" name="end_date" type="text" value="{{ $rental->end_date }}" required>
                @error('end_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="total_cost">Total Cost (Optional)</label>
                <input class="form-control" id="total_cost" name="total_cost" type="number" value="{{ $rental->total_cost }}">
                @error('total_cost')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Pending" {{ $rental->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Ongoing" {{ $rental->status == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                    <option value="Completed" {{ $rental->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="Canceled" {{ $rental->status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                </select>
                @error('status')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <button class="btn btn-outline-success mt-2" type="submit">Update Rental</button>
    </form>
@endsection

@section('scripts')
    <script>
        $(function() {
            var unavailableDates = @json($unavailableDates);

            function disableDates(date) {
                var today = new Date();
                today.setHours(0, 0, 0, 0);
                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);

                if (date < today || unavailableDates.indexOf(string) != -1) {
                    return [false];
                } else {
                    return [true];
                }
            }

            $("#start_date, #end_date").datepicker({
                dateFormat: 'yy-mm-dd',
                beforeShowDay: disableDates
            });

            $('#front_rental_form').on('submit', function() {
                $('#submitBtn').prop('disabled', true);
                $('#submitBtn').html('Processing...');
            });
        });
    </script>
@endsection
