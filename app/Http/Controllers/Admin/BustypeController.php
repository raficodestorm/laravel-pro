<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Bustype;
use Illuminate\Http\Request;

class BustypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Bustype::orderBy('type', 'asc')->get();
        return view('pages.admin.bustype.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.bustype.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $velidated = $request->validate([
            'type' => 'required|string|max:100|unique:bustypes,type',
        ]);

        Bustype::create($velidated);

        return redirect()->route('admin.bustypes.index')->with('success', 'Bus type added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bustype $bustype)
    {
        return view('pages.admin.bustype.show', compact('bustype'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bustype $bustype)
    {
        return view('pages.admin.bustype.edit', compact('bustype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bustype $bustype)
    {
        $velidated = $request->validate([
            'type' => 'required|string|max:100|unique:bustypes,type',
        ]);

        $bustype->update($velidated);

        return redirect()->route('admin.bustypes.index')->with('success', 'Bus type updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bustype $bustype)
    {
        $bustype->delete();
        return redirect()->route('admin.bustypes.index')->with('success', 'Bus type deleted successfully!');
    }
}
