@extends('layouts.app')

@section('content')
    @include('partials._alerts')

    <div class="d-flex">
        <!-- Fixed Filter Section -->
        <div class="col-md-2" style="position: fixed; left: 0; top: 0; height: 100%; overflow-y: auto; background-color: #f8f9fa; z-index: 1000; margin-top: 20px;">
            <form method="GET" action="{{ route('frontend.cars.index') }}" class="p-4 bg-light rounded shadow">
                <br>
                <h4 class="text-center text-info">Filters</h4>
                <div class="form-group">
                    <label for="type" class="form-label text-primary">Car Type</label>
                    <select class="form-control border-info" id="type" name="type">
                        <option value="">All</option>
                        @foreach ($car_types as $type)
                            <option value="{{ $type->car_type }}" @if (request('type') == $type->car_type) selected @endif>{{ $type->car_type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="brand" class="form-label text-primary">Brand</label>
                    <select class="form-control border-info" id="brand" name="brand">
                        <option value="">All</option>
                        @foreach ($car_brands as $brand)
                            <option value="{{ $brand->brand }}" @if (request('brand') == $brand->brand) selected @endif>{{ $brand->brand }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="search" class="form-label text-primary">Price Filter</label>
                    <input class="form-control border-info" id="search" name="price" type="text" value="{{ request('price') }}" placeholder="Show vehicles under given price">
                </div>
                <button class="btn btn-info w-100 mt-3" type="submit">Apply Filters</button>
            </form>

            <!-- Clock and Calendar Section -->
            <div class="text-center mt-4">
                <div id="clock" class="h5 text-info"></div>
                <div id="calendar" class="h6 text-primary"></div>
            </div>
        </div>

        <div class="col-md-10" style="margin-left: 25%; padding: 0;">
            <div class="text-center my-4">
                <h2 class="text-center text-info">All Cars</h2>
                <p class="text-center">Find the perfect vehicle for your next adventure</p>
            </div>

            <div class="row mt-4">
                @foreach ($cars as $car)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm border-0" style="border-radius: 15px; height: 100%;">
                            <img class="card-img-top" src="{{ $car->image }}" alt="{{ $car->brand }} - {{ $car->car_type }}" style="height: 200px; object-fit: cover; border-radius: 15px 15px 0 0;">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title text-info">{{ $car->brand }} - {{ $car->car_type }}</h5>
                                    <h6 class="card-text">Daily Rent Price: <span class="text-success">${{ $car->daily_rent_price }}</span></h6>
                                </div>
                                <a class="btn btn-outline-info mt-2" href="{{ route('frontend.cars.show', $car->id) }}">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function updateClock() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const date = now.toLocaleDateString(undefined, options);
            const time = now.toLocaleTimeString();

            document.getElementById('clock').textContent = time;
            document.getElementById('calendar').textContent = date;
        }

        setInterval(updateClock, 1000);
        updateClock(); // Initial call to display immediately
    </script>
@endsection
