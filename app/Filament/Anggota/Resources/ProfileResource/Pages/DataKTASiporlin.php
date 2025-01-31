<?php

namespace App\Filament\Anggota\Resources\ProfileResource\Pages;

use App\Filament\Anggota\Resources\ProfileResource;
use App\Filament\Anggota\Resources\ProfileResource\Components\LayoutProfile;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;

class DataKTASiporlin extends LayoutProfile
{
    protected static string $resource = ProfileResource::class;

    protected static string $view = 'filament.anggota.resources.profile-resource.pages.data-k-t-a-siporlin';

    public $kartu;

    public function mount() : void
    {
        $this->kartu = Auth::user()->kartu;

        parent::mount();
    }
}
