<?php

namespace App\Filament\Admin\Resources\RekomendasiSikResource\Pages;

use App\Filament\Admin\Resources\RekomendasiSikResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRekomendasiSiks extends ListRecords
{
    protected static string $resource = RekomendasiSikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
