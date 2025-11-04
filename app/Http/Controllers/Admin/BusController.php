<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return view('pages.admin.bus.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'coach_no' => 'required|integer',
            'license' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'bus_type' => 'required|string|max:255',
            'seat_layout' => 'required|string|max:255',
            'route' => 'required|string|max:255',
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
        return view('pages.admin.bus.edit', compact('bus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bus $bus)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'coach_no' => 'required|string|max:10',
            'license' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'bus_type' => 'required|string|max:255',
            'seat_layout' => 'required|string|max:255',
            'route' => 'required|string|max:255',
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
