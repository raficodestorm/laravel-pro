<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $counters = Counter::orderBy('id', 'asc')->paginate(10);
        return view('pages.admin.counter.index', compact('counters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.counter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'location' => 'required|string|max:100',
            'manager' => 'required|string|max:100',
            'district_id' => 'nullable|integer',
            'distance' => 'nullable|integer',
        ]);

        Counter::create($request->only('location', 'manager','district_id','distance'));

        return redirect()->route('admin.locations.index')->with('success', 'Counter added successfully!');
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
    public function edit(Counter $counter)
    {
        return view('pages.admin.counter.edit', compact('counter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Counter $counter)
    {
        $request->validate([
            'location' => 'required|string|max:100',
            'manager' => 'required|string|max:100',
            'district_id' => 'nullable|integer',
            'distance' => 'nullable|integer',
        ]);

        $counter->update($request->only('location', 'manager','district_id','distance'));

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
