<?php

namespace App\Filament\Anggota\Pages;
use App\models\pendidikan;
use App\Models\str;
use App\Models\pekerjaan;
use App\Models\anggota;
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
    public $str;
    public $pendidikan;
    public $pekerjaan;
    public $anggota;

    public function mount()
    {
        $this->user = Auth::user();

        // Mengambil data NO STR, pendidikan > Alumnus, pekerjaan > Mulai bekerja,user yang sedang login berdasarkan NIK
        $this->str = Str::where('nik', $this->user->nik)->first();
        $this->pendidikan = Pendidikan::where('nik', $this->user->nik)->first();
        $this->pekerjaan = Pekerjaan::where('nik', $this->user->nik)->first();
        $this->anggota = Anggota::where('nik' , $this->user->nik)->first();
        }

}
