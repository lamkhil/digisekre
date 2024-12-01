<?php

namespace App\Filament\Anggota\Resources\MutasiResource\Pages;

use App\Filament\Anggota\Resources\MutasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMutasi extends EditRecord
{
    protected static string $resource = MutasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }


    protected static ?string $title = "Edit Mutasi";
}
