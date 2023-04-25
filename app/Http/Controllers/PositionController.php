<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $position = Position::all();
        return Inertia::render('Position/Index',['position' => $position]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Position/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['code' => 'required|max:100']);
        $request->validate(['name' => 'required|max:100']);
        $position = new Position($request->input());
        $position->save();
        return redirect('position');
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        return Inertia::render('Position/Edit',['position' => $position]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        $request->validate(['code' => 'required|max:100']);
        $request->validate(['name' => 'required|max:100']);
        $position->update($request->all());
        return redirect('position');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        $position->delete();
        return redirect('position');
    }
}
