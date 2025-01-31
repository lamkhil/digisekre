<?php

namespace App\Filament\Anggota\Resources\ProfileResource\Pages;

use App\Filament\Anggota\Resources\ProfileResource;
use App\Filament\Anggota\Resources\ProfileResource\Components\LayoutProfile;
use Illuminate\Support\Facades\Auth;

class DataPekerjaan extends LayoutProfile
{
    protected static string $resource = ProfileResource::class;

    protected static string $view = 'filament.anggota.resources.profile-resource.pages.data-pekerjaan';

    public $pekerjaan;

    public function mount() :void
    {
        $this->pekerjaan = Auth::user()->pekerjaan;

        parent::mount();
    }
}
