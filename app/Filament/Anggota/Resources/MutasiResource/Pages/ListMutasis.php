<?php

namespace App\Filament\Anggota\Resources\MutasiResource\Pages;

use App\Filament\Anggota\Resources\MutasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMutasis extends ListRecords
{
    protected static string $resource = MutasiResource::class;

    protected static ?string $title = "Mutasi";

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Ajukan Mutasi'),
        ];
    }
}
