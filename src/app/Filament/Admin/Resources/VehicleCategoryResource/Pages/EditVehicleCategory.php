<?php

namespace App\Filament\Admin\Resources\VehicleCategoryResource\Pages;

use App\Filament\Admin\Resources\VehicleCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVehicleCategory extends EditRecord
{
    protected static string $resource = VehicleCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
