<?php

namespace App\Filament\Anggota\Resources\RekomendasiResource\Pages;

use App\Filament\Anggota\Resources\RekomendasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRekomendasi extends EditRecord
{
    protected static string $resource = RekomendasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
