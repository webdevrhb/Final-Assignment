@extends('layouts.app')

@section('content')
    @include('partials._alerts')

    <div class="col-12 mt-4">
    <div class="row p-4 shadow-sm rounded bg-light">
        <!-- Car Details Section -->
        <div class="col-md-6">
            <h3 class="text-info">{{ $car->brand }}</h3>
            <p><strong>Model:</strong> {{ $car->model }}</p>
            <p><strong>Daily Rent Price:</strong> <span class="font-weight-bold text-success">$ {{ $car->daily_rent_price }}</span></p>
            <p><strong>Year:</strong> {{ $car->year }}</p>
            <p><strong>Type:</strong> {{ $car->car_type }}</p>
            <img class="img-thumbnail my-2" src="{{ asset($car->image) }}" alt="{{ $car->brand }} - {{ $car->car_type }}" style="width: 50%; border-radius: 10px; object-fit: cover;">
        </div>

        <!-- Booking Form Section -->
        <div class="col-md-6">
            <div class="p-4 shadow-lg rounded bg-white">
                <form id="front_rental_form" action="{{ route('frontend.rentals.store') }}" method="POST">
                    @csrf
                    <input name="car_id" type="hidden" value="{{ $car->id }}">

                    <div class="row g-3">
                        <div class="form-group">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input class="form-control border-info" id="start_date" name="start_date" type="text" required>
                            @error('start_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="end_date" class="form-label">End Date</label>
                            <input class="form-control border-info" id="end_date" name="end_date" type="text" required>
                            @error('end_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <button class="btn btn-outline-info mt-3 w-100" id="submitBtn" type="submit">Book Now</button>
                </form>
            </div>
        </div>
    </div>
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
