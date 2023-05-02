<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Travel extends Model
{
    use HasFactory;
        protected $fillable = [
        'ref_num',
        'created_by',
        'updated_by'
    ];

    protected $table = 'travel';

    protected $with = ['trips', 'employee', 'position', 'nature', 'recommending', 'approving', 'passenger'];
    
    public function trips()
    {
        return $this->hasMany(\App\Models\Trip::class);
    }

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

    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }
}

