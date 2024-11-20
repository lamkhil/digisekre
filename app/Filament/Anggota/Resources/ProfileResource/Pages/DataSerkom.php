<?php

namespace App\Filament\Anggota\Resources\ProfileResource\Pages;

use App\Filament\Anggota\Resources\ProfileResource;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;

class DataSerkom extends Page
{
    protected static string $resource = ProfileResource::class;

    protected static string $view = 'filament.anggota.resources.profile-resource.pages.data-serkom';

    public $serkom;

    public function mount()
    {
        $this->serkom = Auth::user()->serkom;
    }

}
