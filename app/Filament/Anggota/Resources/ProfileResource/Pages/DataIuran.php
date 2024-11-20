<?php

namespace App\Filament\Anggota\Resources\ProfileResource\Pages;

use App\Filament\Anggota\Resources\ProfileResource;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;

class DataIuran extends Page
{
    protected static string $resource = ProfileResource::class;

    protected static string $view = 'filament.anggota.resources.profile-resource.pages.data-iuran';

    public $iuran;

    public function mount()
    {
        $this->iuran = Auth::user()->iuran;
    }

}
