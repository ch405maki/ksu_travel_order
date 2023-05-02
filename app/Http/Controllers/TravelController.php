<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use App\Models\Nature;
use App\Models\Recommending;
use App\Models\Approving;
use App\Models\Travel;
use App\Models\Trip;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $travel = Travel::with(['employee', 'position', 'nature', 'recommending', 'approving', 'trip', 'passenger'])->paginate(10);

        $employee = Employee::all();
        $position = Position::all();
        $nature = Nature::all();
        $recommending = Recommending::all();
        $approving = Approving::all();
        $trip = Trip::all();
        $passenger = Passenger::all();

        $travel = Travel::all();

        return Inertia::render('Travel/Index',
            [   
                'travel' => $travel,
                'employee' =>$employee,
                'position'=> $position,
                'nature' => $nature,
                'recommending' => $recommending,
                'approving' => $approving,
                'trip' => $trip,
                'passenger' => $passenger
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
        
        $travel = new Travel([
            'ref_num' => $request->ref_num,
            'created_by' => $request->created_by,
            'updated_by' => $request->updated_by
        ]);
        // Save the new Travel record
        // Create a new Trip record
        if($travel->save())
        {
            $trip = new Trip([
                'travel_id' => $travel->id,
                'time_travel' => $request->time_travel,
                'date_from_travel' => $request->date_from_travel,
                'date_to_travel' => $request->date_to_travel,
                'purpose' => $request->purpose,
                'source' => $request->source,
                'destination' => $request->destination,
                'nature_id' => $request->nature_id,
                'recommending_id' => $request->recommending_id,
                'approving_id' => $request->approving_id,
                'recommended_at' => $request->recommended_at,
                'approved_at' => $request->approved_at
            ]);
            
            // Save the new Trip record
            if ($trip->save()) {
                // Create a new Passenger record
                $passenger = new Passenger([
                    'trip_id' => $trip->id,
                    'employee_id' => $request->employee_id,
                    'position_id' => $request->position_id
                ]);
                // Save the new Passenger record
                $passenger->save();
            
                // Create relationships between the Trip, Travel, and Passenger records
                $trip->travel()->associate($travel);
                $passenger->trip()->attach($trip);
            
                return redirect('travel');
            } else {
                // Travel was not saved successfully
                return redirect('travel')->with('error', 'There was an error saving.');
            }
        }else {
            // Travel was not saved successfully
            return redirect('travel')->with('error', 'There was an error saving.');
        }
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
