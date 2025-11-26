<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_list_id',
        'employee_name',
        'ot_date',
        'start_time',
        'end_time',
        'hours',
    ];

    protected $casts = [
        'ot_date' => 'date',
        'hours' => 'decimal:2',
    ];

    public function employeeList()
    {
        return $this->belongsTo(EmployeeList::class, 'employee_list_id');
    }
}