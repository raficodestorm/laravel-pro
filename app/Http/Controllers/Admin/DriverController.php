<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Route;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $drivers = Driver::get();
        return view('pages.admin.driver.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $routes = Route::orderBy('route_code', 'asc')->get();
        return view('pages.admin.driver.create', compact('routes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'father' => 'required|string|max:100',
            'phone' => 'required|string|max:100',
            'license' => 'required|string|max:100',
            'address' => 'required|string|max:100',
            'route_id' => 'nullable|integer',
        ]);

        Driver::create($validated);
        return redirect()->route('admin.drivers.index')->with('seccess', 'driver added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        return view('pages.admin.driver.show', compact('driver'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver)
    {
        $routes = Route::orderBy('route_code', 'asc')->get();
        return view('pages.admin.driver.edit', compact('driver', 'routes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Driver $driver)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'father' => 'required|string|max:100',
            'phone' => 'required|string|max:100',
            'license' => 'required|string|max:100',
            'address' => 'required|string|max:100',
            'route_id' => 'nullable|integer',
        ]);
        $driver->update($validated);
        return redirect()->route('admin.drivers.index')->with('success', 'Driver updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('admin.drivers.index')->with('success', 'Drivere deleted successfully');
    }
}
