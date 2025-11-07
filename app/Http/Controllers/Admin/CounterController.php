<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Models\Location;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $counters = Counter::with('locationinfo')->orderBy('id', 'asc')->paginate(10);
        return view('pages.admin.counter.index', compact('counters'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $locations = Location::orderBy('district')->get();
        return view('pages.admin.counter.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'manager' => 'required|string|max:100',
            'location_id' => 'nullable|integer',
            'distance' => 'nullable|integer',
            'address' => 'nullable|string',
        ]);

        Counter::create($request->only('name', 'manager', 'location_id', 'distance', 'address'));

        return redirect()->route('admin.counters.index')->with('success', 'Counter added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Counter $counter)
    {
        return view('pages.admin.counter.show', compact('counter'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {
        $counter = Counter::findOrFail($id);
        $locations = Location::orderBy('district')->get();

        return view('pages.admin.counter.edit', compact('counter', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Counter $counter)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'manager' => 'required|string|max:100',
            'location_id' => 'nullable|integer',
            'distance' => 'nullable|integer',
            'address' => 'required|string',
        ]);

        $counter->update($request->only('name', 'manager', 'location_id', 'distance', 'address'));

        return redirect()->route('admin.counters.index')->with('success', 'Counter updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Counter $counter)
    {
        $counter->delete();
        return redirect()->route('admin.counters.index')->with('success', 'Counter deleted successfully!');
    }
}
