<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approving extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'position_id'];
}
