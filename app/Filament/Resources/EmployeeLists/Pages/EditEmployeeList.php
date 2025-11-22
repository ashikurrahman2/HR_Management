<?php

namespace App\Filament\Resources\EmployeeLists\Pages;

use App\Filament\Resources\EmployeeLists\EmployeeListResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEmployeeList extends EditRecord
{
    protected static string $resource = EmployeeListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
