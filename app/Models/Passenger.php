<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Passenger extends Model
{
    use HasFactory;
    protected $fillable = [
        'trip_id',
        'employee_id',
        'position_id'
    ];

    protected $table = 'passengers';

    protected $with = ['employee'];

    // protected $with = ['trip'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function trip()
    {
        return $this->belongsTo(\App\Models\Trip::class);
    }

}
