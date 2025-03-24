<?php

namespace App\Filament\Anggota\Resources;

use App\Filament\Anggota\Resources\PengaturanResource\Pages;
use App\Filament\Anggota\Resources\PengaturanResource\RelationManagers;
use App\Models\Pengaturan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengaturanResource extends Resource
{

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?string $navigationGroup = 'Umum';
    
    protected static ?string $pluralLabel = "Pengaturan";
    protected static ?string $modelLabel = "Pengaturan";
    protected static ?string $navigationLabel = "Pengaturan";

    public static function getPages(): array
    {
        return [
            'index' => Pages\Pengaturan::route('/'),
            'edit-email' => Pages\EditEmail::route('/edit-email'),
        ];
    }
}
