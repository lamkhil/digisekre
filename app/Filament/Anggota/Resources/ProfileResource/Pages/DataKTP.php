<?php

namespace App\Filament\Anggota\Resources\ProfileResource\Pages;

use App\Filament\Anggota\Resources\ProfileResource;
use Filament\Resources\Pages\Page;

class DataKTP extends Page
{
    protected static string $resource = ProfileResource::class;

    protected static string $view = 'filament.anggota.resources.profile-resource.pages.data-k-t-p';
}
