<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bus;
use App\Models\Bustype;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Route;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buses = Bus::all();
        return view('pages.admin.bus.index', compact('buses'));
    }

    public function create()
    {
        $types = Bustype::get();
        $routes = Route::orderBy('route_code', 'asc')->get();
        return view('pages.admin.bus.create', compact('types', 'routes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'coach_no' => 'required|integer',
            'license' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'bus_type' => 'required|string|max:255',
            'route' => 'required|string|max:255',
            'seat_layout' => 'required|string|max:255',
            'seat_capacity' => 'required|integer',
        ]);

        Bus::create($validated);

        return redirect()->route('admin.buses.index')->with('success', 'Bus added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bus $bus)
    {
        return view('pages.admin.bus.show', compact('bus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bus $bus)
    {
        $types = Bustype::get();
        $routes = Route::orderBy('route_code', 'asc')->get();
        return view('pages.admin.bus.edit', compact('bus', 'types','routes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bus $bus)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'coach_no' => 'required|integer',
            'license' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'bus_type' => 'required|string|max:255',
            'route' => 'required|string|max:255',
            'seat_layout' => 'required|string|max:255',
            'seat_capacity' => 'required|integer',
        ]);
        $bus->update($validated);
        return redirect()->route('admin.buses.index')->with('success', 'Bus updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bus $bus)
    {
        $bus->delete();
        return redirect()->route('admin.buses.index')->with('success', 'Bus deleted successfully');
    }
}
