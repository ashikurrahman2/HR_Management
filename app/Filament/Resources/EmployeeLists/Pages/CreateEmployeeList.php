<?php

namespace App\Filament\Resources\EmployeeLists\Pages;

use App\Filament\Resources\EmployeeLists\EmployeeListResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEmployeeList extends CreateRecord
{
    protected static string $resource = EmployeeListResource::class;
}
