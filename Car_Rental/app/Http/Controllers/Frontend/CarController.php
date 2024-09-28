<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Car::query();

        if (request('brand') != null) {
            $query->where('brand', request('brand'));
        }

        if (request('type') != null) {
            $query->where('car_type', request('type'));
        }

        if (request('price') != null) {
            $query->where('daily_rent_price', '<=', request('price'));
        }

        $cars = $query->where('availability', true)->get();
        $car_types = Car::select('car_type')->distinct()->where('availability', true)->get();
        $car_brands = Car::select('brand')->distinct()->where('availability', true)->get();

        $data = [
            'cars' => $cars,
            'car_types' => $car_types,
            'car_brands' => $car_brands,
        ];
        return view('frontend.cars.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    // --------------------------------------
    // Helper function to get the date range between two dates in an array format
    private function getDateRange($start_date, $end_date)
    {
        $dates = [];
        $start = strtotime($start_date);
        $end = strtotime($end_date);
        while ($start <= $end) {
            $dates[] = date('Y-m-d', $start);
            $start = strtotime('+1 day', $start);
        }
        return $dates;
    }
    // --------------------------------------


    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        $unavailableDates = Rental::where('status', 'Ongoing')->orWhere('status', 'Pending')->where('car_id', $car->id)->get()->flatMap(function ($rental) {
            return $this->getDateRange($rental->start_date, $rental->end_date);
        })->unique()->values()->toArray();

        $data = [
            'car' => $car,
            'unavailableDates' => $unavailableDates,
        ];

        return view('frontend.cars.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}