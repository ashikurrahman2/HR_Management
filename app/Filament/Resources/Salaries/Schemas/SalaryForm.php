<?php

namespace App\Filament\Resources\Salaries\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SalaryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('employee_name')
                    ->label('কর্মচারীর নাম')
                    ->required()
                    ->maxLength(255),
                
                TextInput::make('designation')
                    ->label('পদবী')
                    ->required()
                    ->maxLength(255),
                
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
                    ->default(0),
                
                TextInput::make('house_rent')
                    ->label('বাড়ি ভাড়া ভাতা')
                    ->numeric()
                    ->prefix('৳')
                    ->default(0),
                
                TextInput::make('medical_allowance')
                    ->label('চিকিৎসা ভাতা')
                    ->numeric()
                    ->prefix('৳')
                    ->default(0),
                
                TextInput::make('bonus')
                    ->label('বোনাস')
                    ->numeric()
                    ->prefix('৳')
                    ->default(0),
                
                TextInput::make('deductions')
                    ->label('মোট কর্তন (ট্যাক্স + অন্যান্য)')
                    ->numeric()
                    ->prefix('৳')
                    ->default(0),
                
                Placeholder::make('net_salary')
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
            ->columns(3); // Apply columns to the entire form
    }
}