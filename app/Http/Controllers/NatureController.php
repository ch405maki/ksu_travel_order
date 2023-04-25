<?php

namespace App\Http\Controllers;

use App\Models\Nature;
use Illuminate\Http\Request;
use Inertia\Inertia;


class NatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nature = Nature::all();
        return Inertia::render('Nature/Index',['nature' => $nature]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Nature/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|max:100']);
        $nature = new Nature($request->input());
        $nature->save();
        return redirect('nature');
    }

    /**
     * Display the specified resource.
     */
    public function show(Nature $nature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nature $nature)
    {
        return Inertia::render('Nature/Edit',['nature' => $nature]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nature $nature)
    {
        $request->validate(['name' => 'required|max:100']);
        $nature->update($request->all());
        return redirect('nature');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nature $nature)
    {
        $nature->delete();
        return redirect('nature');
    }
}
