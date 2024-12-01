<?php

namespace App\Filament\Anggota\Resources\MutasiResource\Pages;

use App\Filament\Anggota\Resources\MutasiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMutasi extends CreateRecord
{
    protected static string $resource = MutasiResource::class;


    protected static ?string $title = "Ajukan Mutasi";
}
