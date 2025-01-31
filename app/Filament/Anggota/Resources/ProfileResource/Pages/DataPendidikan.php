<?php

namespace App\Filament\Anggota\Resources\ProfileResource\Pages;

use App\Filament\Anggota\Resources\ProfileResource;
use App\Filament\Anggota\Resources\ProfileResource\Components\LayoutProfile;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;

class DataPendidikan extends LayoutProfile
{
    protected static string $resource = ProfileResource::class;

    protected static string $view = 'filament.anggota.resources.profile-resource.pages.data-pendidikan';

    public $pendidikan;

    public function mount():void
    {
        $this->pendidikan = Auth::user()->pendidikan;

        parent::mount();
    }
}
