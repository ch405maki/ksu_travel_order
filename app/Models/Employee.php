<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['name','email','phone','department_id', 'role_id', 'position_id'];

    protected $with = ['department', 'role', 'position'];

    public function department()
    {
        return $this->belongsTo(Department::class);

    }

    public function role()
    {
        return $this->belongsTo(Role::class);

    }

    public function position()
    {   

        return $this->belongsTo(Position::class);
    }
}
