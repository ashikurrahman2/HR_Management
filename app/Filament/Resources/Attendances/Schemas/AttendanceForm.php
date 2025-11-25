<?php

namespace App\Filament\Resources\Attendances\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class AttendanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
               Select::make('user_id')
                    ->label('কর্মচারী')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('employee_name')
                    ->label('কর্মচারীর নাম')
                    ->required()
                    ->maxLength(255),
                TextInput::make('designation')
                    ->label('পদবী')
                    ->required()
                    ->maxLength(255),
               DatePicker::make('date')
                    ->label('তারিখ')
                    ->required()
                    ->native(false)
                    ->default(now())
                    ->displayFormat('d/m/Y'),
               TimePicker::make('check_in')
                    ->label('প্রবেশ সময়')
                    ->seconds(false)
                    ->native(false),
                TimePicker::make('check_out')
                    ->label('প্রস্থান সময়')
                    ->seconds(false)
                    ->native(false),
               TextInput::make('total_hours')
                    ->label('মোট সময় (ঘণ্টা)')
                    ->numeric()
                    ->step(0.5)
                    ->suffix('ঘণ্টা'),
            Select::make('status')
                    ->label('স্ট্যাটাস')
                    ->options([
                        'present' => 'উপস্থিত',
                        'absent' => 'অনুপস্থিত',
                        'late' => 'বিলম্বে',
                        'leave' => 'ছুটি',
                    ])
                    ->required()
                    ->default('present')
                    ->native(false),

                    Textarea::make('notes')
                    ->label('মন্তব্য')
                    ->rows(3)
                    ->columnSpanFull(),
            ])
            ->columns(3);
            
    }
}
