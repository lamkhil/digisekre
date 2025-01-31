<?php 

namespace App\Filament\Anggota\Resources\ProfileResource\Components;

use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;

class LayoutProfile extends Page
{
    public $anggota;

    public function mount():void 
    {
        $this->anggota = Auth::user()->anggota;
    }
}