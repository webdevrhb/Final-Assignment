<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCars = Car::count();
        $availableCars = Car::where('availability', true)->count();
        $totalRentals = Rental::count();
        $totalEarnings = Rental::where('status', 'Completed')->sum('total_cost');

        $data = [
            'totalCars' => $totalCars,
            'availableCars' => $availableCars,
            'totalRentals' => $totalRentals,
            'totalEarnings' => $totalEarnings,
        ];

        return view('admin.dashboard', $data);
    }
}