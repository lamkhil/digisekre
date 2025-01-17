<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MutasiResource\Pages;
use App\Filament\Admin\Resources\MutasiResource\RelationManagers;
use App\Models\Dpc;
use App\Models\Instansi;
use App\Models\KabKota;
use App\Models\Mutasi;
use App\Models\Pengajuan;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MutasiResource extends Resource
{
    protected static ?string $model = Pengajuan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Mutasi';

    protected static ?string $navigationGroup = 'Pengajuan';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Mutasi';
    
    protected static ?string $breadcrumb = "Mutasi";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('nik')
                    ->default(Filament::auth()->user()->nik),
                Forms\Components\Hidden::make('jenis')
                    ->default('Mutasi'),
                Forms\Components\Hidden::make('nama')
                    ->default(Filament::auth()->user()->anggota?->nama),
                Forms\Components\Hidden::make('kta')
                    ->default(Filament::auth()->user()->kartu?->nomor),
                Forms\Components\TextInput::make('dpc')
                    ->label('DPC')
                    ->default(Filament::auth()->user()->dpc)
                    ->readOnly(),
                Forms\Components\TextInput::make('tempat_kerja')
                    ->label('Tempat Kerja')
                    ->default(Filament::auth()->user()->pekerjaan?->nama_instansi)
                    ->readOnly(),
                Forms\Components\TextInput::make('kab_kota')
                    ->label('Kab/Kota')
                    ->default(Filament::auth()->user()->pekerjaan?->kab_kota)
                    ->readOnly(),
                Forms\Components\Select::make('dpc_baru')
                    ->label('DPC Baru')
                    ->searchable()
                    ->options(
                        Dpc::all()->pluck('nama_dpc', 'nama_dpc')
                    )
                    ->required(),
                Forms\Components\Select::make('kab_kota_baru')
                    ->label('Kab/Kota Baru')
                    ->searchable()
                    ->options(
                        KabKota::all()->pluck('nama_kab', 'nama_kab')
                    )
                    ->required(),
                Forms\Components\Select::make('tempat_kerja_baru')
                    ->searchable()
                    ->label('Tempat Kerja Baru')
                    ->options(
                        Instansi::all()->pluck('nama_instansi', 'nama_instansi')
                    ),
                Forms\Components\Select::make('cpd')
                    ->label('CPD')
                    ->native(false)
                    ->options([
                        'Punya' => 'Punya',
                        'Belum Punya' => 'Belum Punya',
                    ]),
                Forms\Components\Select::make('sanksi')
                    ->label('Sanksi')
                    ->native(false)
                    ->options([
                        'Pernah' => 'Pernah',
                        'Belum Pernah' => 'Belum Pernah',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(
                function ($query) {
                    if (Filament::auth()->user()->is_admin == "Admin") {
                        $query->where('dpc', Filament::auth()->user()->dpc);
                    }
                    return $query
                        ->where('jenis', 'Mutasi');
                }
            )
            ->defaultSort('created_at', 'desc')
            ->emptyStateDescription('Belum ada data pengajuan mutasi')
            ->emptyStateHeading('Tidak ada data')
            ->columns([

                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->default('Diajukan')
                    ->color(function ($state) {
                        return match ($state) {
                            'Disetujui' => 'success',
                            'Ditolak' => 'danger',
                            default => 'warning',
                        };
                    })
                    ->label('Status'),
                Tables\Columns\TextColumn::make('pesan')
                    ->label('Pesan')
                    ->wrap(),
                Tables\Columns\TextColumn::make('kta')
                    ->label('KTA'),
                Tables\Columns\TextColumn::make('dpc')
                    ->label('DPC'),
                Tables\Columns\TextColumn::make('tempat_kerja')
                    ->label('Tempat Kerja'),

                Tables\Columns\TextColumn::make('kab_kota')
                    ->label('Kab/Kota'),
                Tables\Columns\TextColumn::make('dpc_baru')
                    ->label('DPC Baru'),

                Tables\Columns\TextColumn::make('kab_kota_baru')
                    ->label('Kab/Kota Baru'),
                Tables\Columns\TextColumn::make('tempat_kerja_baru')
                    ->label('Tempat Kerja Baru'),
                Tables\Columns\TextColumn::make('cpd')
                    ->label('CPD'),
                Tables\Columns\TextColumn::make('sanksi')
                    ->label('Sanksi'),
                Tables\Columns\TextColumn::make('verifikator')
                    ->label('Verifikator'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada'),

                Tables\Columns\TextColumn::make('tanggal_verif')
                    ->label('Diverifikasi Pada'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(function ($record) {
                        return $record->status == null;
                    }),
                Tables\Actions\Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-o-archive-box-arrow-down')
                    ->visible(function ($record) {
                        return $record->status == 'Disetujui';
                    })
                    ->url(function ($record) {
                        return asset('storage/' . $record->mutasi?->dokumen);
                    }),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMutasis::route('/'),
            'create' => Pages\CreateMutasi::route('/create'),
            'edit' => Pages\EditMutasi::route('/{record}/edit'),
        ];
    }
}
