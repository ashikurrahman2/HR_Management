<?php

namespace App\Filament\Resources\Salaries\Schemas;

use App\Models\EmployeeList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SalaryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('employee_list_id')
                    ->label('কর্মচারী খুঁজুন (নাম/পদবী)')
                    ->relationship('employeeList', 'employee_name')
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->employee_name} - {$record->designation}")
                    ->searchable()
                    ->preload()
                    ->required()
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $employee = EmployeeList::find($state);
                        if ($employee) {
                            $set('employee_name', $employee->employee_name);
                            $set('designation', $employee->designation);
                            $set('basic_salary', $employee->salary);
                        }
                    }),
                
                // ✅ Hidden ফিল্ড যোগ করুন
                Hidden::make('employee_name'),
                Hidden::make('designation'),
                
                DatePicker::make('salary_month')
                    ->label('বেতন মাস')
                    ->required()
                    ->displayFormat('F Y')
                    ->native(false),
                
                TextInput::make('basic_salary')
                    ->label('মূল বেতন')
                    ->required()
                    ->numeric()
                    ->prefix('৳')
                    ->default(0)
                    ->live(onBlur: true),
                
                TextInput::make('house_rent')
                    ->label('বাড়ি ভাড়া ভাতা')
                    ->numeric()
                    ->prefix('৳')
                    ->default(0)
                    ->live(onBlur: true),
                
                TextInput::make('medical_allowance')
                    ->label('চিকিৎসা ভাতা')
                    ->numeric()
                    ->prefix('৳')
                    ->default(0)
                    ->live(onBlur: true),
                
                TextInput::make('bonus')
                    ->label('বোনাস')
                    ->numeric()
                    ->prefix('৳')
                    ->default(0)
                    ->live(onBlur: true),
                
                TextInput::make('deductions')
                    ->label('মোট কর্তন (ট্যাক্স + অন্যান্য)')
                    ->numeric()
                    ->prefix('৳')
                    ->default(0)
                    ->live(onBlur: true),
                
                Placeholder::make('net_salary_display')
                    ->label('নেট বেতন')
                    ->content(function ($get) {
                        $net = ($get('basic_salary') ?? 0) 
                             + ($get('house_rent') ?? 0) 
                             + ($get('medical_allowance') ?? 0) 
                             + ($get('bonus') ?? 0) 
                             - ($get('deductions') ?? 0);
                        return '৳ ' . number_format($net, 2);
                    }),
            ])
            ->columns(3);
    }
}