<?php

namespace App\Filament\Admin\Resources\VehicleCategoryResource\Pages;

use App\Filament\Admin\Resources\VehicleCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVehicleCategories extends ListRecords
{
    protected static string $resource = VehicleCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
