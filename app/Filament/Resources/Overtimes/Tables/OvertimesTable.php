<?php

namespace App\Filament\Resources\Overtimes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class OvertimesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employeeList.employee_name')
                    ->label('কর্মচারীর নাম')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('employeeList.designation')
                    ->label('পদবী')
                    ->searchable(),
               TextColumn::make('ot_date')
                    ->label('তারিখ')
                    ->date('d/m/Y')
                    ->sortable(),
              TextColumn::make('start_time')
                    ->label('শুরু')
                    ->time('H:i'),
            TextColumn::make('end_time')
                    ->label('শেষ')
                    ->time('H:i'),

               TextColumn::make('hours')
                    ->label('ঘণ্টা')
                    ->numeric(2)
                    ->suffix(' ঘণ্টা')
                    ->color('success')
                    ->weight('bold')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('employee_list_id')
                    ->label('কর্মচারী')
                    ->relationship('employeeList', 'employee_name')
                    ->searchable()
                    ->preload(),
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
