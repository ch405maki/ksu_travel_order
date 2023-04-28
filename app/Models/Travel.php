<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;
        protected $fillable = [
        'ref_num',
        'time_travel',
        'date_from_travel',
        'date_to_travel',
        'purpose',
        'source',
        'destination',
        'employee_id',
        'position_id',
        'nature_id',
        'recommending_id',
        'approving_id',
        'recommended_at',
        'approved_at',
        'created_by',
        'updated_by'
    ];

    protected $with = ['employee', 'position', 'nature', 'recommending', 'approving'];


    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function position()
    {   
        return $this->belongsTo(Position::class);
    }

    public function nature()
    {
        return $this->belongsTo(Nature::class);
    }

    public function recommending()
    {
        return $this->belongsTo(Recommending::class);
    }

    public function approving()
    {
        return $this->belongsTo(Approving::class);
    }
}
