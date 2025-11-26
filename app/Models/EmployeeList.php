<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeList extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id_number',
        'employee_name',
        'designation',
        'section',
        'salary',
        'status',
    ];

    protected $casts = [
        'salary' => 'decimal:2',
    ];

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    public function getFormattedSalaryAttribute(): string
    {
        return number_format($this->salary, 2);
    }

    // রিলেশন: এই কর্মচারীর সব বেতন
    public function salaries()
    {
        return $this->hasMany(Salary::class, 'employee_list_id');
    }

    // সর্বশেষ বেতন
    public function latestSalary()
    {
        return $this->hasOne(Salary::class, 'employee_list_id')->latestOfMany();
    }

    // Scope for active employees
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    // Scope for inactive employees
    public function scopeInactive($query)
    {
        return $query->where('status', self::STATUS_INACTIVE);
    }
}