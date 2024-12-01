<?php

namespace App\Filament\Anggota\Resources\RekomendasiResource\Pages;

use App\Filament\Anggota\Resources\RekomendasiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRekomendasi extends CreateRecord
{
    protected static string $resource = RekomendasiResource::class;


    protected static ?string $title = "Ajukan Rekomendasi";
}
