<?php

namespace App\Http\Controllers;

use App\Models\Recommending;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RecommendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recommending = Recommending::all();
        return Inertia::render('Recommending/Index',['recommending' => $recommending]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Recommending/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|max:100']);
        $recommending = new Recommending($request->input());
        $recommending->save();
        return redirect('recommending');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recommending $recommending)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recommending $recommending)
    {
        return Inertia::render('Recommending/Edit',['recommending' => $recommending]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recommending $recommending)
    {
        $request->validate(['name' => 'required|max:100']);
        $recommending->update($request->all());
        return redirect('recommending');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recommending $recommending)
    {
        //
    }
}
