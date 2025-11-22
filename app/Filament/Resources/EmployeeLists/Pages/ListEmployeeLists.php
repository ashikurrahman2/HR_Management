<?php

namespace App\Filament\Resources\EmployeeLists\Pages;

use App\Filament\Resources\EmployeeLists\EmployeeListResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEmployeeLists extends ListRecords
{
    protected static string $resource = EmployeeListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
