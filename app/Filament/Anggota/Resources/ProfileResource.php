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

    protected static ?string $navigationGroup = 'Umum';

    protected static ?string $breadcrumb = "Profil";

    protected static ?string $navigationLabel = 'Profil';

    public static function getPages(): array
    {
        return [
            'index' => Pages\ProfilSaya::route('/'),
            'edit' => Pages\EditDataDiri::route('/edit'),
            'pekerjaan' => Pages\DataPekerjaan::route('/pekerjaan'),
            'str' => Pages\DataSTR::route('/str'),
            'pendidikan' => Pages\DataPendidikan::route('/pendidikan'),
            'serkom' => Pages\DataSerkom::route('/serkom'),
            'sumprof' => Pages\DataSumprof::route('/sumprof'),
            'iuran' => Pages\DataIuran::route('/iuran'),
            'ktp' => Pages\DataKTP::route('/ktp'),
            'kta-siporlin' => Pages\DataKTASiporlin::route('/kta'),
            'editstr' => Pages\EditStr::route('/editstr'),
            'edit-serkom' => Pages\EditSerkom::route('/edit-serkom'),
            'edit-pekerjaan' => Pages\EditPekerjaan::route('/edit-pekerjaan'),
            'edit-sumprof' => Pages\EditSumprof::route('/edit-sumprof'),
            'edit-iuran' => Pages\EditIuran::route('/edit-iuran'),
            'edit-pendidikan' => Pages\EditPendidikan::route('/edit-pendidikan'),
            'edit-kta-siporlin' => Pages\EditKTASiporlin::route('/edit-kta-siporlin'),
        ];
    }
}
