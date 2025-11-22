<?php

namespace App\Filament\Resources\EmployeeLists;

use App\Filament\Resources\EmployeeLists\Pages\CreateEmployeeList;
use App\Filament\Resources\EmployeeLists\Pages\EditEmployeeList;
use App\Filament\Resources\EmployeeLists\Pages\ListEmployeeLists;
use App\Filament\Resources\EmployeeLists\Schemas\EmployeeListForm;
use App\Filament\Resources\EmployeeLists\Tables\EmployeeListsTable;
use App\Models\EmployeeList;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EmployeeListResource extends Resource
{
    protected static ?string $model = EmployeeList::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return EmployeeListForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EmployeeListsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEmployeeLists::route('/'),
            'create' => CreateEmployeeList::route('/create'),
            'edit' => EditEmployeeList::route('/{record}/edit'),
        ];
    }
}
