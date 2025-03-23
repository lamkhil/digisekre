<?php

namespace App\Filament\Admin\Resources\IuranResource\Pages;

use App\Filament\Admin\Resources\IuranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIurans extends ListRecords
{
    protected static string $resource = IuranResource::class;


    protected static ?string $title = "Iuran";

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\CreateAction::make()
    //         ->label('Tambah Iuran'),
    //     ];
    // }
}
