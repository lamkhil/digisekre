<?php

namespace App\Filament\Anggota\Resources\RekomendasiResource\Pages;

use App\Filament\Anggota\Resources\RekomendasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRekomendasis extends ListRecords
{
    protected static string $resource = RekomendasiResource::class;

    protected static ?string $title = "Rekomendasi";

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Ajukan Rekomendasi'),
        ];
    }
}
