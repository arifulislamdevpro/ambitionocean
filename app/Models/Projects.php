<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
     use HasFactory;

    // ✅ Table name (optional if default)
    protected $table = 'projects';

    // ✅ Mass assignable fields
    protected $fillable = [
        'name',
        'description',
    ];
}
