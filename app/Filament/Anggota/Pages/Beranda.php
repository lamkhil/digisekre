<?php

namespace App\Filament\Anggota\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class Beranda extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.anggota.pages.beranda';

    protected static ?string $navigationLabel = "Beranda";

    protected static ?string $navigationGroup = 'Umum';

    protected static ?string $title = '';

    // Page Data
    
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

}
