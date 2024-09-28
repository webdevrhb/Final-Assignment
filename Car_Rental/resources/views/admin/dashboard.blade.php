@extends('layouts.admin')

@section('content')

<div class="row d-flex justify-content-center gap-2 mt-4">
    <div class="col-md-2">
        <div class="card bg-dark border-info border-2 text-white shadow-lg" style="border-radius: 15px; height: 150px;">
            <div class="card-header text-center bg-info text-dark" style="font-weight: bold; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                Total Cars
            </div>
            <div class="card-body d-flex justify-content-center align-items-center">
                <h5 class="card-title display-6" style="font-weight: bold;">{{ $totalCars }}</h5>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card bg-dark border-info border-2 text-white shadow-lg" style="border-radius: 15px; height: 150px;">
            <div class="card-header text-center bg-info text-dark" style="font-weight: bold; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                Available Cars
            </div>
            <div class="card-body d-flex justify-content-center align-items-center">
                <h5 class="card-title display-6" style="font-weight: bold;">{{ $availableCars }}</h5>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card bg-dark border-info border-2 text-white shadow-lg" style="border-radius: 15px; height: 150px;">
            <div class="card-header text-center bg-info text-dark" style="font-weight: bold; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                Total Rentals
            </div>
            <div class="card-body d-flex justify-content-center align-items-center">
                <h5 class="card-title display-6" style="font-weight: bold;">{{ $totalRentals }}</h5>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card bg-dark border-info border-2 text-white shadow-lg" style="border-radius: 15px; height: 150px;">
            <div class="card-header text-center bg-info text-dark" style="font-weight: bold; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                Total Earnings
            </div>
            <div class="card-body d-flex justify-content-center align-items-center">
                <h5 class="card-title display-6" style="font-weight: bold;">${{ $totalEarnings }}</h5>
            </div>
        </div>
    </div>
</div>

@endsection
