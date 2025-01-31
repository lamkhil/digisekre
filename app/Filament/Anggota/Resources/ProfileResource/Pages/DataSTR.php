<?php

namespace App\Filament\Anggota\Resources\ProfileResource\Pages;

use App\Filament\Anggota\Resources\ProfileResource;
use App\Filament\Anggota\Resources\ProfileResource\Components\LayoutProfile;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;

class DataSTR extends LayoutProfile
{
    protected static string $resource = ProfileResource::class;

    protected static string $view = 'filament.anggota.resources.profile-resource.pages.data-s-t-r';

    public $str;

    public function mount() :void
    {
        $this->str = Auth::user()->str;

        parent::mount();
    }

}
