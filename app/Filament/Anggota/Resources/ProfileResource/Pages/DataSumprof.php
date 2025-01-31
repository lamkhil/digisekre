<?php

namespace App\Filament\Anggota\Resources\ProfileResource\Pages;

use App\Filament\Anggota\Resources\ProfileResource;
use App\Filament\Anggota\Resources\ProfileResource\Components\LayoutProfile;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;

class DataSumprof extends LayoutProfile
{
    protected static string $resource = ProfileResource::class;

    protected static string $view = 'filament.anggota.resources.profile-resource.pages.data-sumprof';

    public $sumprof;

    public function mount() : void
    {
        $this->sumprof = Auth::user()->sumprof;

        parent::mount();
    }
}
