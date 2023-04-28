<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use App\Models\Nature;
use App\Models\Recommending;
use App\Models\Approving;
use App\Models\Travel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $travel = Travel::with(['employee', 'position', 'nature', 'recommending', 'approving'])->paginate(10);

        $employee = Employee::all();
        $position = Position::all();
        $nature = Nature::all();
        $recommending = Recommending::all();
        $approving = Approving::all();

        return Inertia::render('Travel/Index',
            [   
                'travel' => $travel,
                'employee' =>$employee,
                'position'=> $position,
                'nature' => $nature,
                'recommending' => $recommending,
                'approving' => $approving
            ]);
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
            'ref_num' => 'required',
            'time_travel' => 'required',
            'date_from_travel' => 'required',
            'date_to_travel' => 'required',
            'purpose' => 'required',
            'source' => 'required',
            'destination' => 'required',
            'employee_id' => 'required',
            'position_id' => 'required',
            'nature_id' => 'required|numeric',
            'recommending_id' => 'required',
            'approving_id' => 'required',
            'recommended_at' => 'required',
            'approved_at' => 'required',
            'created_by' => 'required',
            'updated_by' => 'required'
        ]);

        $travel = new Travel($request->input());
        $travel->save();
        return redirect('travel');
    }

    /**
     * Display the specified resource.
     */
    public function show(Travel $travel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Travel $travel)
    {
        return Inertia::render('Travel/Edit',['travel' => $travel]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Travel $travel)
    {
        $request->validate([
            'ref_num' => 'required',
            'time_travel' => 'required',
            'date_from_travel' => 'required',
            'date_to_travel' => 'required',
            'purpose' => 'required',
            'source' => 'required',
            'destination' => 'required',
            'employee_id' => 'required',
            'position_id' => 'required',
            'nature_id' => 'required|numeric',
            'recommending_id' => 'required',
            'approving_id' => 'required',
            'recommended_at' => 'required',
            'approved_at' => 'required',
            'created_by' => 'required',
            'updated_by' => 'required'
        ]);

        $travel->update($request->input());
        return redirect('travel');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Travel $travel)
    {
        $travel->delete();
        return redirect('travel');
    }
}
