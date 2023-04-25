<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Role;
use App\Models\Position;
use App\Models\Approving;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ApprovingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $approving = Approving::select('approvings.id', 'approvings.name','position_id','positions.name as position')
            ->join('positions', 'positions.id', '=', 'approvings.position_id')
            ->paginate(10);
    
        $position = Position::all();
        return Inertia::render('Approving/Index', ['approving' => $approving, 'position' => $position]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:150',
            'position_id' => 'required|numeric'
        ]);
        $approving = new Approving($request->input());
        $approving->save();
        return redirect('approving');
    }

    /**
     * Display the specified resource.
     */
    public function show(Approving $approving)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Approving $approving)
    {
        return Inertia::render('Approving/Edit',['approving' => $approving]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Approving $approving)
    {
        $request->validate([
            'name' => 'required|max:150',
            'position_id' => 'required|numeric'
        ]);
        $approving->update($request->input());
        return redirect('approving');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Approving $approving)
    {
        $approving->delete();
        return redirect('approving');
    }
}
