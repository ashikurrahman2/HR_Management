<?php

namespace App\Filament\Resources\Overtimes\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OvertimeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // TextInput::make('employee_list_id')
                //     ->numeric(),
                // TextInput::make('employee_name')
                //     ->required(),
                // DatePicker::make('ot_date')
                //     ->required(),
                // TextInput::make('start_time')
                //     ->required(),
                // TextInput::make('end_time')
                //     ->required(),
                // TextInput::make('hours')
                //     ->required()
                //     ->numeric(),
            ]);
    }
}
