<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Superviser;
use App\Models\Route;
use Illuminate\Http\Request;

class SuperviserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supervisers = Superviser::get();
        return view('pages.admin.superviser.index', compact('supervisers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $routes = Route::orderBy('route_code', 'asc')->get();
        return view('pages.admin.superviser.create', compact('routes'));
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
            'address'=> 'required|string|max:100',
            'route_id' => 'nullable|integer',
        ]);
        Superviser::create($validated);
        return redirect()->route('admin.supervisers.index')->with('success', 'Superviser added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Superviser $superviser)
    {
        return view('pages.admin.superviser.show', compact('superviser'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Superviser $superviser)
    {
        $routes = Route::orderBy('route_code', 'asc')->get();
        return view('pages.admin.superviser.edit', compact('superviser', 'routes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Superviser $superviser)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'father' => 'required|string|max:100',
            'phone' => 'required|string|max:100',
            'address'=> 'required|string|max:100',
            'route_id' => 'nullable|integer',
        ]);

        $superviser->update($validated);
        return redirect()->route('admin.supervisers.index')->with('success', 'Supervisers updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Superviser $superviser)
    {
        $superviser->delete();
        return redirect()->route('admin.supervisers.index')->with('success', 'Superviser deleted successfully');
    }
}
