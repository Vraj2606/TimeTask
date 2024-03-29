<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{
    use HasFactory;
    protected $table = 'employee_attendance';

    protected $fillable = ['employee_id', 'date', 'in_time', 'out_time'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
