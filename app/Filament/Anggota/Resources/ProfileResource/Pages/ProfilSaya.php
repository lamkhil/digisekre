<?php

namespace App\Filament\Anggota\Resources\ProfileResource\Pages;

use App\Filament\Anggota\Resources\ProfileResource;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;

class ProfilSaya extends Page
{

    protected static string $resource = ProfileResource::class;

    protected static string $view = 'filament.anggota.resources.profile-resource.pages.profil-saya';
    
    public $anggota;

    public function mount()
    {
        $this->anggota = Auth::user()->anggota;
    }

}
