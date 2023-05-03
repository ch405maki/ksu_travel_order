<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trip extends Model
{
    use HasFactory;
    protected $fillable = [
        'travel_id',
        'time_travel',
        'date_from_travel',
        'date_to_travel',
        'purpose',
        'source',
        'destination',
        'nature_id',
        'recommending_id',
        'approving_id',
        'recommended_at',
        'approved_at'
    ];

    protected $table = 'trips';
    // protected $with = ['travel','employee', 'position', 'nature', 'recommending', 'approving', 'trip', 'passengers'];

    protected $with = ['passengers'];


    public function travel()
    {
        return $this->belongsTo(\App\Models\Travel::class);
    }

    public function passengers()
    {
        return $this->hasMany(\App\Models\Passenger::class, 'trip_id', 'id');
    }
    
}