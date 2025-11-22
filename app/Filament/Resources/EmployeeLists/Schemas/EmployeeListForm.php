<?php

namespace App\Filament\Resources\EmployeeLists\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class EmployeeListForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                 TextInput::make('employee_id_number')
                    ->required(),

                    TextInput::make('employee_name')
                    ->required(),

                      TextInput::make('designation')
                    ->required(),

                    
                      TextInput::make('section')
                    ->required(),

                          TextInput::make('salary')
                            ->required(),

                Toggle::make('status') 
                    ->label('Active Status')
                    ->default(true)
                    ->inline(false)
                    ->helperText('Enable to show this content on the website'),

            ]);
    }
}
