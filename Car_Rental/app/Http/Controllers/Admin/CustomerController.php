<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
   
    public function index()
    {
        $customers = User::where('role', 'customer')->get();
        return view('admin.customers.index', compact('customers'));
    }

   
    public function create()
    {
        return view('admin.customers.create');
    }

   
    public function store(Request $request)
    {

        $credentials = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'phone' => $credentials['phone'],
            'address' => $credentials['address'],
            'role' => 'customer',
        ]);

        if (!$user) {
            return back()->with('error', 'Failed to create customer');
        }

        return redirect()->route('admin.customers.index')->with('success', 'Customer created successfully');
    }

   
    public function show(User $customer)
    {
        return view('admin.customers.show', ['customer' => $customer]);
    }

    
    public function edit(User $customer)
    {
        return view('admin.customers.edit', ['customer' => $customer]);
    }

   
    public function update(Request $request, User $customer)
    {
        $credentials = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $customer->id,
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $customer->update($credentials);

        return redirect()->route('admin.customers.index')->with('success', 'Customer updated successfully');
    }

 
    public function destroy(User $customer)
    {
        $customer->delete();
        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted successfully');
    }
}