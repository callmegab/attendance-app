<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    // protected $fillable = ['employee_name', 'date', 'status'];
    protected $fillable = ['employee_name', 'date', 'status', 'deadline_start', 'deadline_end', 'logged_in_at'];
    protected $casts = [
        'date' => 'date', // or 'datetime' if it includes time
    ];

}
