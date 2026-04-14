<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'iqama',
        'department_id',
        'designation',
        'joining_date',
        'status'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}