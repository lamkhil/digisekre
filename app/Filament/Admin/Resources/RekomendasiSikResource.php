<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RekomendasiSikResource\Pages;
use App\Filament\Admin\Resources\RekomendasiSikResource\RelationManagers;
use App\Models\Pengajuan;
use App\Models\RekomendasiSik;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;
use App\Models\User;

use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Infolists\Infolist;

class RekomendasiSikResource extends Resource
{
    protected static ?string $model = Pengajuan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    protected static ?string $navigationLabel = 'Rekomendasi SIK';

    protected static ?string $navigationGroup = 'Pengajuan';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Rekomendasi SIK';
    
    protected static ?string $breadcrumb = "Rekomendasi SIK";

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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
        ->schema([
            Group::make([
                Section::make()
                    ->schema([
                        TextEntry::make('jenis')
                            ->label('Jenis Pengajuan')
                            ->badge()
                            ->inlineLabel()
                            ->size(TextEntrySize::Large)
                            ->default('Rekomendasi Sik'),
                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(function ($state) {
                                return match ($state) {
                                    'Disetujui' => 'success',
                                    'Ditolak' => 'danger',
                                    default => 'warning',
                                };
                            })
                            ->inlineLabel()
                            ->size(TextEntrySize::Large)
                            ->default('Diajukan'),
                    ])->columns(2)
                    ->columnSpanFull(),
            ])->columns(4)
                ->columnSpanFull(),
                        
        Section::make('Informasi Pengajuan')
        ->schema([
            TextEntry::make('nik')
                ->label('NIK')
                ->default(Filament::auth()->user()->nik),
    
            TextEntry::make('jenis')
                ->label('Jenis')
                ->default('Rekomendasi SIK'),
    
            TextEntry::make('tanggal_lahir')
                ->label('Tanggal Lahir')
                ->default(Filament::auth()->user()->anggota?->tanggal_lahir),
    
            TextEntry::make('nama')
                ->label('Nama')
                ->default(Filament::auth()->user()->anggota?->nama),
    
            TextEntry::make('dpc')
                ->label('DPC')
                ->default(Filament::auth()->user()->dpc),
    
            TextEntry::make('tempat_kerja')
                ->label('Tempat Kerja')
                ->default(Filament::auth()->user()->pekerjaan?->nama_instansi),
    
            TextEntry::make('kab_kota')
                ->label('Kab/Kota')
                ->default(Filament::auth()->user()->pekerjaan?->kab_kota),
    
            TextEntry::make('kta')
                ->label('KTA')
                ->default(Filament::auth()->user()->kartu?->nomor),
    
            TextEntry::make('pendidikan')
                ->label('Pendidikan')
                ->default(Filament::auth()->user()->pendidikan?->prodi),
        ])->columns(3)
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(
                function ($query) {
                     $query->where('jenis', 'Rekomendasi SIK');

                    if (Filament::auth()->user()->is_admin == 'Admin') {
                        return $query;
                    } else {
                        return $query->where('dpc', Filament::auth()->user()->dpc);
                    }
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
                Tables\Actions\Action::make('validasi')
                    ->label('Validasi')
                    ->icon('heroicon-o-check-circle')
                    ->modalHeading('Validasi Rekomendasi SIK')
                    ->form([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->native(false)
                            ->options([
                                'Disetujui' => 'Disetujui',
                                'Ditolak' => 'Ditolak'
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('pesan')
                            ->label('Pesan')
                            ->required()
                    ])
                    ->action(function ($record, $data) {
                        $record->approveRekomendasiSik($data);
                    })
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
            'index' => Pages\ListRekomendasiSiks::route('/'),
            'create' => Pages\CreateRekomendasiSik::route('/create'),
            // 'edit' => Pages\EditRekomendasiSik::route('/{record}/edit'),
            'view' => Pages\ViewRekomendasiSik::route('/{record}/view'),
        ];
    }
}
