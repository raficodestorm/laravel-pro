<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = Route::paginate(10);
        return view('pages.admin.route.index', compact('routes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.route.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'route_code' => 'required|string|max:100',
            'start_location' => 'required|string|max:100',
            'end_location' => 'required|string|max:100',
        ]);

        Route::create($validated);
        return redirect()->route('routes.index')->with('success', 'Route added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Route $route)
    {
        return view('pages.admin.route.show', compact('route'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Route $route)
    {
        return view('pages.admin.route.edit', compact('route'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Route $route)
    {
        $validated = $request->validate([
            'route_code' => 'required|string|max:100',
            'start_location' => 'required|string|max:100',
            'end_location' => 'required|string|max:100',
        ]);

        $route->update($validated);
        return redirect()->route('routes.index')->with('success', 'Route updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        $route->delete();
        return redirect()->route('routes.index')->with('success', 'Route deleted successfully!');
    }
}
