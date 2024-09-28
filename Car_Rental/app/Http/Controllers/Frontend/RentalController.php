<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RentalController extends Controller
{
    
    public function index()
    {
        $currentBookings = Rental::where('user_id', Auth::id())->where(function ($query) {
            $query->where('status', 'Ongoing')
                ->orWhere('status', 'Pending');
        })->get();

        $pastBookings = Rental::where('user_id', Auth::id())->where(function ($query) {
            $query->where('status', 'Completed')
                ->orWhere('status', 'Canceled');
        })->get();

        $data = [
            'currentBookings' => $currentBookings,
            'pastBookings' => $pastBookings,
        ];
        return view('frontend.bookings.index', $data);
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $car = Car::find($request->car_id);

        $existingRentals = Rental::where('car_id', $request->car_id)->where('status', 'Ongoing')->orWhere('status', 'Pending')
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                    ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('start_date', '<=', $request->start_date)
                            ->where('end_date', '>=', $request->end_date);
                    })
                    ->orWhere(function ($query) use ($request) {
                        $query->where('start_date', '>=', $request->start_date)
                            ->where('end_date', '<=', $request->end_date);
                    });
            })
            ->exists();

        if ($existingRentals) {
            return redirect()->back()->with('error', 'Car is not available for the selected dates');
        }


        $cost = $car->daily_rent_price * (strtotime($request->end_date) - strtotime($request->start_date)) / (60 * 60 * 24);
        $rental = Rental::create([
            'user_id' => $request->user()->id,
            'car_id' => $request->car_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_cost' => $cost,
            'status' => Carbon::parse($request->start_date)->isFuture() ? 'Pending' : 'Ongoing',
        ]);

        $user = $request->user();

        $mail_data = [
            'id' => $rental->id,
            'name' => $user->name,
            'car_name' => $car->name,
            'car_brand' => $car->brand,
            'car_model' => $car->model,
            'car_year' => $car->year,
            'car_type' => $car->car_type,
            'start_date' => $rental->start_date,
            'end_date' => $rental->end_date,
            'total_cost' => $cost,
        ];

        $admin_email = User::where('role', 'admin')->first()->email;
        Mail::to($user->email)->send(new \App\Mail\CustomerNotification($mail_data));


        $mail_data['name'] = $user->name;
        $mail_data['email'] = $user->email;
        $mail_data['phone'] = $user->phone;
        Mail::to($admin_email)->send(new \App\Mail\AdminNotification($mail_data));

        return redirect()->route('frontend.rentals.index')->with('success', 'Rental created successfully');
    }

    
    public function update(Request $request, Rental $rental)
    {
        $request->validate([
            'status' => 'required|in:Ongoing,Completed,Canceled',
        ]);

        $rental->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Rental updated successfully');
    }

    
}