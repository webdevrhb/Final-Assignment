@extends('layouts.admin')

@section('content')
    @include('partials._alerts')
    <h2>Add Rental</h2>

    <div class="d-flex justify-content-around align-items-center my-5 rounded p-2 shadow">
        <div>
            <h3>{{ $car->brand }}</h3>
            <p>Model: {{ $car->model }}</p>
            <p>Daily Rent Price: <span class="font-weight-bold">$ {{ $car->daily_rent_price }}</span></p>
            <p>Year: {{ $car->year }}</p>
            <p>Type: {{ $car->car_type }}</p>
        </div>
        <div>
            <img class="img-thumbnail" src="{{ asset($car->image) }}" alt="{{ $car->brand }} - {{ $car->car_type }}" style="height: 180px;">
        </div>
    </div>

    <div class="rounded p-2 shadow">
        <form id="front_rental_form" action="{{ route('admin.rentals.store') }}" method="POST">
            @csrf
            <input name="car_id" type="hidden" value="{{ $car->id }}">
            <div class="row gap-2">
                <div class="form-group">
                    <label for="user_id">Customer</label>
                    <select class="form-control" id="user_id" name="user_id" required>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" {{ old('user_id') == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input class="form-control" id="start_date" name="start_date" type="text" value="{{ old('start_date') }}" required>
                    @error('start_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input class="form-control" id="end_date" name="end_date" type="text" value="{{ old('end_date') }}" required>
                    @error('end_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="total_cost">Total Cost (Optional)</label>
                    <input class="form-control" id="total_cost" name="total_cost" type="number" value="{{ old('total_cost') }}">
                    @error('total_cost')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option selected>Select an option</option>
                        <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Ongoing" {{ old('status') == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Canceled" {{ old('status') == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <button class="btn btn-outline-success mt-2" id="submitBtn" type="submit">Add Rental</button>
        </form>
    </div>
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
