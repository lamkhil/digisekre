<?php

namespace App\Filament\Anggota\Resources\MutasiResource\Pages;

use App\Filament\Anggota\Resources\MutasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMutasi extends ViewRecord
{
    protected static string $resource = MutasiResource::class;


    protected static ?string $title = "Detail Mutasi";
}
