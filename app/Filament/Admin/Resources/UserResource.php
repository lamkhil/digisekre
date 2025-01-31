<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Admin\Resources\UserResource\RelationManagers;
use App\Models\Dpc;
use App\Models\Pekerjaan;
use App\Models\User;
use App\Models\WilayahDesa;
use App\Models\WilayahKabupaten;
use App\Models\WilayahKecamatan;
use App\Models\WilayahProvinsi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    protected static ?string $navigationLabel = 'Anggota';

    protected static ?string $navigationGroup = 'Manajemen';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Anggota';

    protected static ?string $breadcrumb = "Anggota";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('is_admin')
                    ->default('Anggota'),
                Forms\Components\Section::make('Data Akun')
                    ->schema([
                        Forms\Components\TextInput::make('nik')
                            ->label('NIK')
                            ->unique('users', 'nik', ignoreRecord: true)
                            ->required(),
                        Forms\Components\TextInput::make('name')
                            ->label('Nama')
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->unique('users', 'email', ignoreRecord: true)
                            ->required(),
                        Forms\Components\Select::make('dpc')
                            ->label('DPC')
                            ->options(function () {
                                return Dpc::query()
                                    ->pluck('nama_dpc', 'nama_dpc')
                                    ->toArray();
                            })
                            ->searchable()
                            ->required(),
                        Forms\Components\Select::make('is_admin')
                            ->label('Role')
                            ->options([
                                'Admin' => 'Admin',
                                'Anggota' => 'Anggota',
                            ])
                            ->native(false)
                            ->required(),
                        Forms\Components\TextInput::make('wa')
                            ->label('Whatsapp')
                            ->required(),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                            ->dehydrated(fn(?string $state): bool => filled($state))
                            ->required(fn(string $operation): bool => $operation === 'create')
                            ->revealable(fn(string $operation): bool => $operation === 'create')
                            ->confirmed(fn(string $operation): bool => $operation === 'create'),
                        Forms\Components\TextInput::make('password_confirmation')
                            ->password()
                            ->required(fn(string $operation): bool => $operation === 'create')
                            ->revealable(fn(string $operation): bool => $operation === 'create')

                    ])
                    ->columns(2),
                Forms\Components\Section::make('Data Pengguna')
                    ->schema([
                        Forms\Components\Select::make('tempat_lahir')
                            ->options(
                                WilayahKabupaten::query()
                                    ->pluck('nama', 'nama')
                                    ->toArray()
                            )
                            ->label('Tempat Lahir')
                            ->required()
                            ->searchable()
                            ->getSearchResultsUsing(function ($search) {
                                return WilayahKabupaten::where('nama', 'like', '%' . $search . '%')
                                    ->get()
                                    ->mapWithKeys(function ($wilayah) {
                                        return [
                                            $wilayah->nama => $wilayah->nama,
                                        ];
                                    })
                                    ->toArray();
                            })
                            ->getOptionLabelUsing(function ($state) {
                                $wilayah = WilayahKabupaten::where('nama', $state)->first();
                                return $wilayah->nama;
                            }),
                        Forms\Components\Datepicker::make('tanggal_lahir')
                            ->label('Tanggal Lahir')
                            ->required(),
                        Forms\Components\Select::make('jenis_kelamin')
                            ->options([
                                'Laki-laki' => 'Laki-laki',
                                'Perempuan' => 'Perempuan',
                            ])
                            ->label('Jenis Kelamin')
                            ->required()
                            ->native(false),
                        FOrms\Components\Select::make('agama')
                            ->options([
                                'Islam' => 'Islam',
                                'Kristen' => 'Kristen',
                                'Katolik' => 'Katolik',
                                'Hindu' => 'Hindu',
                                'Budha' => 'Budha',
                                'Konghucu' => 'Konghucu',
                            ])
                            ->label('Agama')
                            ->required()
                            ->native(false),
                        Forms\Components\Select::make('gd')
                            ->options([
                                'A' => 'A',
                                'B' => 'B',
                                'AB' => 'AB',
                                'O' => 'O',
                            ])
                            ->label('Golongan Darah')
                            ->required()
                            ->native(false),
                        Forms\Components\Select::make('status')
                            ->options([
                                'Belum Menikah' => 'Belum Menikah',
                                'Menikah' => 'Menikah',
                                'Duda' => 'Duda',
                                'Janda' => 'Janda',
                            ])
                            ->label('Status')
                            ->required()
                            ->native(false),
                        Forms\Components\Textarea::make('alamat')
                            ->label('Alamat')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Group::make([
                            Forms\Components\TextInput::make('rt')
                                ->label('RT')
                                ->numeric()
                                ->required(),
                            Forms\Components\TextInput::make('rw')
                                ->label('RW')
                                ->numeric()
                                ->required(),
                        ])
                            ->columns(),
                        Forms\Components\Select::make('provinsi')
                            ->options(
                                WilayahProvinsi::query()
                                    ->pluck('nama', 'nama')
                                    ->toArray()
                            )
                            ->label('Provinsi')
                            ->required()
                            ->searchable()
                            ->getSearchResultsUsing(function ($search) {
                                return WilayahProvinsi::where('nama', 'like', '%' . $search . '%')
                                    ->get()
                                    ->mapWithKeys(function ($wilayah) {
                                        return [
                                            $wilayah->nama => $wilayah->nama,
                                        ];
                                    })
                                    ->toArray();
                            })
                            ->getOptionLabelUsing(function ($state) {
                                $wilayah = WilayahProvinsi::where('nama', $state)->first();
                                return $wilayah->nama;
                            })
                            ->reactive()
                            ->afterStateUpdated(function ($set) {
                                $set('kab', null);
                                $set('kec', null);
                                $set('desa_kel', null);
                            }),

                        Forms\Components\Select::make('kab')
                            ->options(
                                function($get){
                                    $provinsi = WilayahProvinsi::where('nama', $get('provinsi'))->first();
                                    return WilayahKabupaten::where('provinsi_id', $provinsi?->id)
                                        ->pluck('nama', 'nama')
                                        ->toArray();
                                }
                            )
                            ->label('Kabupaten')
                            ->required()
                            ->disabled(fn($get) => is_null($get('provinsi')))
                            ->searchable()
                            ->getSearchResultsUsing(function ($search, $get) {
                                $provinsi = WilayahProvinsi::where('nama', $get('provinsi'))->first();
                                return WilayahKabupaten::where('nama', 'like', '%' . $search . '%')
                                    ->where('provinsi_id', $provinsi?->id)
                                    ->get()
                                    ->mapWithKeys(function ($wilayah) {
                                        return [
                                            $wilayah->nama => $wilayah->nama,
                                        ];
                                    })
                                    ->toArray();
                            })
                            ->getOptionLabelUsing(function ($state) {
                                $wilayah = WilayahKabupaten::where('nama', $state)->first();
                                return $wilayah?->nama;
                            })
                            ->reactive()
                            ->afterStateUpdated(function ($set) {
                                $set('kec', null);
                                $set('desa_kel', null);
                            }),

                        Forms\Components\Select::make('kec')
                            ->options(
                                function($get){
                                    $kabupaten = WilayahKabupaten::where('nama', $get('kab'))->first();
                                    return WilayahKecamatan::where('kabupaten_id', $kabupaten?->id)
                                        ->pluck('nama', 'nama')
                                        ->toArray();
                                }
                            )
                            ->label('Kecamatan')
                            ->required()
                            ->disabled(fn($get) => is_null($get('kab')))
                            ->searchable()
                            ->getSearchResultsUsing(function ($search, $get) {
                                $kabupaten = WilayahKabupaten::where('nama', $get('kab'))->first();
                                return WilayahKecamatan::where('nama', 'like', '%' . $search . '%')
                                    ->where('kabupaten_id', $kabupaten?->id)
                                    ->get()
                                    ->mapWithKeys(function ($wilayah) {
                                        return [
                                            $wilayah->nama => $wilayah->nama,
                                        ];
                                    })
                                    ->toArray();
                            })
                            ->getOptionLabelUsing(function ($state) {
                                $wilayah = WilayahKecamatan::where('nama', $state)->first();
                                return $wilayah?->nama;
                            })
                            ->reactive()
                            ->afterStateUpdated(function ($set) {
                                $set('desa_kel', null);
                            }),

                        Forms\Components\Select::make('desa_kel')
                            ->options(
                                function($get){
                                    $kecamatan = WilayahKecamatan::where('nama','=', $get('kec'))->first();
                                    return WilayahDesa::where('kecamatan_id', $kecamatan?->id)
                                        ->pluck('nama', 'nama')
                                        ->toArray();
                                }
                            )
                            ->label('Desa/Kelurahan')
                            ->disabled(fn($get) => is_null($get('kec')))
                            ->searchable()
                            ->getSearchResultsUsing(function ($search, $get) {
                                $kecamatan = WilayahKecamatan::where('nama','=', $get('kec'))->first();
                                return WilayahDesa::where('nama', 'like', '%' . $search . '%')
                                    ->where('kecamatan_id', $kecamatan?->id)
                                    ->get()
                                    ->mapWithKeys(function ($wilayah) {
                                        return [
                                            $wilayah->nama => $wilayah->nama,
                                        ];
                                    })
                                    ->toArray();
                            })
                            ->getOptionLabelUsing(function ($state) {
                                $wilayah = WilayahDesa::where('nama', $state)->first();
                                return $wilayah?->nama;
                            }),

                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('is_admin', 'Anggota');
                if (auth()->user()->is_admin == 'Admin') {
                    $query->where('dpc', auth()->user()->dpc);
                }
            })
            ->defaultSort('updated_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('nik')
                    ->searchable()
                    ->label('NIK'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Nama'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label('Email'),
                Tables\Columns\TextColumn::make('dpc')
                    ->searchable()
                    ->label('DPC'),
                Tables\Columns\TextColumn::make('is_admin')
                    ->label('Role'),
                Tables\Columns\TextColumn::make('wa')
                    ->searchable()
                    ->label('Whatsapp'),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->label('Dibuat'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->sortable()
                    ->label('Diubah'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
