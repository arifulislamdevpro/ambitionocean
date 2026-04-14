<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    // ✅ Table name (optional if default)
    protected $table = 'departments';

    // ✅ Mass assignable fields
    protected $fillable = [
        'name',
        'description',
    ];

    // ✅ Relationship: One Department has many Employees
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
