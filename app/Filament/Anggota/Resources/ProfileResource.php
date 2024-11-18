<?php

namespace App\Filament\Anggota\Resources;

use App\Filament\Anggota\Resources\ProfileResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProfileResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function getPages(): array
    {
        return [
            'index' => Pages\ProfilSaya::route('/'),
            'edit' => Pages\EditDataDiri::route('/edit'),
            'pekerjaan' => Pages\DataPekerjaan::route('/pekerjaan'),
            'str' => Pages\DataSTR::route('/str'),
            'pekerjaan' => Pages\DataPekerjaan::route('/pekerjaan'),
            'serkom' => Pages\DataSerkom::route('/serkom'),
            'sumprof' => Pages\DataSumprof::route('/sumprof'),
            'iuran' => Pages\DataIuran::route('/iuran'),
            'ktp' => Pages\DataKTP::route('/ktp'),
            'kta-siporlin' => Pages\DataKTASiporlin::route('/kta'),
        ];
    }
}
