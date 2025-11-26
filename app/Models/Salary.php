<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_list_id',
        'employee_name',
        'designation',
        'salary_month',
        'basic_salary',
        'house_rent',
        'medical_allowance',
        'bonus',
        'deductions',
        'net_salary',
    ];

    protected $casts = [
        'salary_month' => 'date',
        'basic_salary' => 'decimal:2',
        'house_rent' => 'decimal:2',
        'medical_allowance' => 'decimal:2',
        'bonus' => 'decimal:2',
        'deductions' => 'decimal:2',
        'net_salary' => 'decimal:2',
    ];

    // ✅ এই relationship যোগ করুন
    public function employeeList()
    {
        return $this->belongsTo(EmployeeList::class, 'employee_list_id');
    }

    // নেট বেতন অটোমেটিক ক্যালকুলেট
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($salary) {
            $salary->net_salary = $salary->basic_salary 
                                + $salary->house_rent 
                                + $salary->medical_allowance 
                                + $salary->bonus 
                                - $salary->deductions;
        });
    }
}