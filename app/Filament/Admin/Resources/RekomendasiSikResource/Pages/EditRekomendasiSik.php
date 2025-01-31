<?php

namespace App\Filament\Admin\Resources\RekomendasiSikResource\Pages;

use App\Filament\Admin\Resources\RekomendasiSikResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRekomendasiSik extends EditRecord
{
    protected static string $resource = RekomendasiSikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
