<?php

namespace App\Filament\Anggota\Resources\IuranResource\Pages;

use App\Filament\Anggota\Resources\IuranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIuran extends EditRecord
{
    protected static string $resource = IuranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
