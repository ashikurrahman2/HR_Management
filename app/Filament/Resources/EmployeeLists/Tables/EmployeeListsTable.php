<?php

namespace App\Filament\Resources\EmployeeLists\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EmployeeListsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                    TextColumn::make('employee_id_number')
                    ->searchable(),
                    TextColumn::make('employee_name')
                    ->searchable(),
                    TextColumn::make('designation')
                    ->searchable(),
                      TextColumn::make('section')
                    ->searchable(),
                    TextColumn::make('salary')
                    ->searchable(),
                      ToggleColumn::make('status')
                    ->label('Status')
                    ->sortable(),
            ])
            ->filters([
                 SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        1 => 'Active',
                        0 => 'Inactive',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
