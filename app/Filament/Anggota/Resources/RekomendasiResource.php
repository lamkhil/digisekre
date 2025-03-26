<?php

namespace App\Filament\Anggota\Resources;

use App\Filament\Anggota\Resources\RekomendasiResource\Pages;
use App\Models\Dpc;
use App\Models\Instansi;
use App\Models\KabKota;
use App\Models\Pengajuan;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RekomendasiResource extends Resource
{
    protected static ?string $model = Pengajuan::class;

    protected static ?string $breadcrumb = "Rekomendasi";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Rekomendasi SIK';

    protected static ?string $navigationGroup = 'Pengajuan';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('nik')
                    ->default(Filament::auth()->user()->nik),
                Forms\Components\Hidden::make('jenis')
                    ->default('Rekomendasi SIK'),
                Forms\Components\Hidden::make('tanggal_lahir')
                    ->default(Filament::auth()->user()->anggota?->tanggal_lahir),
                Forms\Components\Hidden::make('nama')
                    ->default(Filament::auth()->user()->anggota?->nama),
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
                Forms\Components\TextInput::make('kta')
                    ->label('KTA')
                    ->default(Filament::auth()->user()->kartu?->nomor)
                    ->readOnly(),
                Forms\Components\TextInput::make('pendidikan')
                    ->default(Filament::auth()->user()->pendidikan?->prodi),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(
                function ($query) {
                    return $query->where('nik', Filament::auth()->user()->nik)
                        ->where('jenis', 'Rekomendasi SIK');
                }
            )
            ->defaultSort('created_at', 'desc')
            ->emptyStateDescription('Belum ada data pengajuan rekomendasi')
            ->emptyStateHeading('Tidak ada data')
            ->columns([
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
                        return route('rekomendasi.download', $record->id);
                    }, shouldOpenInNewTab: true),
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
            'index' => Pages\ListRekomendasis::route('/'),
            'create' => Pages\CreateRekomendasi::route('/create'),
            'edit' => Pages\EditRekomendasi::route('/{record}/edit'),
            'view' => Pages\ViewRekomendasi::route('/{record}'),
        ];
    }
}
