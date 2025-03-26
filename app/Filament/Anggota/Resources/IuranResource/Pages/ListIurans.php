<?php

namespace App\Filament\Anggota\Resources\IuranResource\Pages;

use App\Filament\Anggota\Resources\IuranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListIurans extends ListRecords
{
    protected static string $resource = IuranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Iuran'),
        ];
    }


    public function getTitle(): string | Htmlable
    {
        return 'Iuran';
    }
}
