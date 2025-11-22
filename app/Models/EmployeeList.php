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

    // Status constants
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    // Accessor for formatted salary
    public function getFormattedSalaryAttribute(): string
    {
        return number_format($this->salary, 2);
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