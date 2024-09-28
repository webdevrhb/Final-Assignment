<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        return view('admin.cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */


     
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'car_type' => 'required|string|max:255',
            'daily_rent_price' => 'required|numeric|min:1',
            'availability' => 'required|boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/images'), $imageName);
        $img_location = 'uploads/images/' . $imageName;

        Car::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'car_type' => $request->car_type,
            'daily_rent_price' => $request->daily_rent_price,
            'availability' => $request->availability,
            'image' => $img_location,
        ]);

        return redirect()->route('admin.cars.index')->with('success', 'Car created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('admin.cars.edit', ['car' => $car]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'car_type' => 'required|string|max:255',
            'daily_rent_price' => 'required|numeric|min:1',
            'availability' => 'required|boolean',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:4096', // Added 'avif'
        ]);
        

        $car = Car::findOrFail($id);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/images'), $imageName);
            $img_location = 'uploads/images/' . $imageName;
        
            $oldImagePath = public_path($car->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        } else {
            $img_location = $car->image;
        }
        

        $car->update([
            'name' => $request->name,
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'car_type' => $request->car_type,
            'daily_rent_price' => $request->daily_rent_price,
            'availability' => $request->availability,
            'image' => $img_location,
        ]);

        return redirect()->route('admin.cars.index')->with('success', 'Car updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        unlink($car->image);
        $car->delete();
        return redirect()->route('admin.cars.index')->with('success', 'Car deleted successfully');
    }
}