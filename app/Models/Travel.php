<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Travel extends Model
{
    use HasFactory;
        protected $fillable = [
        'ref_num',
        'created_by',
        'updated_by'
    ];

    //protected $table = 'travel';

    protected $with = ['trips'];
    
    public function trips()
    {
        return $this->hasMany(\App\Models\Trip::class);
    }


    
}

