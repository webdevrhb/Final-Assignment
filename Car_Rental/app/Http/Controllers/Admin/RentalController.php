<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RentalController extends Controller
{
   
    public function index()
    {
        $rentals = Rental::latest()->paginate(5);
        $cars = Car::where('availability', true)->get();

        $data = [
            'cars' => $cars,
            'rentals' => $rentals,
        ];

        return view('admin.rentals.index', $data);
    }

   
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
    
    public function create()
    {
        $customers = User::where('role', 'customer')->get();
        $car = Car::findOrFail(request()->id);

        $unavailableDates = Rental::where('status', 'Ongoing')->orWhere('status', 'Pending')->where('car_id', $car->id)->get()->flatMap(function ($rental) {
            return $this->getDateRange($rental->start_date, $rental->end_date);
        })->unique()->values()->toArray();


        $data = [
            'customers' => $customers,
            'car' => $car,
            'unavailableDates' => $unavailableDates,
        ];
        return view('admin.rentals.create', $data);
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'total_cost' => 'nullable|numeric',
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


        $cost_calculation = $car->daily_rent_price * (strtotime($request->end_date) - strtotime($request->start_date)) / (60 * 60 * 24);
        $cost = $request->total_cost ?? $cost_calculation;

        $rental = Rental::create([
            'user_id' => $request->user_id,
            'car_id' => $request->car_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_cost' => $cost,
            'status' => $request->status,
        ]);

        $user = User::find($request->user_id);

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

        Mail::to($user->email)->send(new \App\Mail\CustomerNotification($mail_data));


        $mail_data['name'] = $user->name;
        $mail_data['email'] = $user->email;
        $mail_data['phone'] = $user->phone;

        Mail::to($request->user()->email)->send(new \App\Mail\AdminNotification($mail_data));

        return redirect()->route('admin.rentals.index')->with('success', 'Rental created successfully');
    }

 
   
    public function edit(Rental $rental)
    {
        $customers = User::where('role', 'customer')->get();

        $car = Car::find($rental->car_id);

        $unavailableDates = Rental::where('status', 'Ongoing')->orWhere('status', 'Pending')->where('car_id', $car->id)->get()->flatMap(function ($rental) {
            return $this->getDateRange($rental->start_date, $rental->end_date);
        })->unique()->values()->toArray();


        $data = [
            'customers' => $customers,
            'car' => $car,
            'rental' => $rental,
            'unavailableDates' => $unavailableDates,
        ];
        return view('admin.rentals.edit', $data);
    }

    public function update(Request $request, Rental $rental)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'total_cost' => 'nullable|numeric|',
        ]);

        $car = Car::find($request->car_id);
        $cost_calculation = $car->daily_rent_price * (strtotime($request->end_date) - strtotime($request->start_date)) / (60 * 60 * 24);
        $cost = $request->total_cost ?? $cost_calculation;

        $rental->update([
            'user_id' => $request->user_id,
            'car_id' => $request->car_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_cost' => $cost,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.rentals.index')->with('success', 'Rental updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rental $rental)
    {
        $rental->delete();
        return redirect()->route('admin.rentals.index')->with('success', 'Rental deleted successfully');
    }
}