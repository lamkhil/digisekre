<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\IuranResource\Pages;
use App\Filament\Admin\Resources\IuranResource\RelationManagers;
use App\Models\Dpc;
use App\Models\Iuran;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Notifications\Notification;

class IuranResource extends Resource
{
    protected static ?string $model = Iuran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Iuran';

    protected static ?string $navigationGroup = 'Pengajuan';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Iuran';

    protected static ?string $breadcrumb = "Iuran";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Data Iuran')
                    ->schema([
                        Forms\Components\Select::make('anggota_nik')
                            ->label('NIK')
                            ->required()
                            ->options(function () {
                                return User::query()
                                    ->when(auth()->user()->is_admin == 'Super Admin', function ($query) {
                                        return $query->where('dpc', auth()->user()->dpc);
                                    })
                                    ->take(50)
                                    ->get()
                                    ->mapWithKeys(function ($user) {
                                        // Custom HTML layout untuk opsi select
                                        return [
                                            $user->nik => "
                                            <div style='display: flex; flex-direction: column;'>
                                                <span style='font-weight: bold; font-size: 14px;'>{$user->name} | {$user->nik}</span>
                                            <span style='font-size: 12px; color: #888;'>{$user->email}</span>
                                            <span style='font-size: 10px; color: #000;'>DPC {$user->dpc}</span>
                                            </div>
                                        ",
                                        ];
                                    })
                                    ->toArray();
                            })
                            ->getSearchResultsUsing(function ($search) {
                                return User::where('name', 'like', '%' . $search . '%')
                                    ->when(auth()->user()->is_admin == 'Admin', function ($query) {
                                        return $query->where('dpc', auth()->user()->dpc);
                                    })
                                    ->orWhere('nik', 'like', '%' . $search . '%')
                                    ->get()
                                    ->mapWithKeys(function ($user) {
                                        // Custom HTML layout untuk opsi select
                                        return [
                                            $user->nik => "
                                        <div style='display: flex; flex-direction: column;'>
                                            <span style='font-weight: bold; font-size: 14px;'>{$user->name} | {$user->nik}</span>
                                            <span style='font-size: 12px; color: #888;'>{$user->email}</span>
                                            <span style='font-size: 10px; color: #000;'>DPC {$user->dpc}</span>
                                        </div>
                                    ",
                                        ];
                                    })
                                    ->toArray();
                            })
                            ->getOptionLabelUsing(
                                function ($state) {
                                    $user = User::where('nik', $state)->first();
                                    return "
                                            <div style='display: flex; flex-direction: column;'>
                                            <span style='font-weight: bold; font-size: 14px;'>{$user->name} | {$user->nik}</span>
                                            <span style='font-size: 12px; color: #888;'>{$user->email}</span>
                                            <span style='font-size: 10px; color: #000;'>DPC {$user->dpc}</span>
                                        </div>
                                        ";
                                }
                            )->columnSpanFull()
                            ->searchable()
                            ->reactive()
                            ->allowHtml()
                            ->afterStateUpdated(function ($state, $set) {
                                $user = User::where('nik', $state)->first();
                                $set('nama', $user->name);
                                $set('dpc', $user->dpc);
                            }),
                        Forms\Components\TextInput::make('nama')->readOnly(),
                        Forms\Components\TextInput::make('dpc')->label('DPC')->readOnly(),
                        Forms\Components\TextInput::make('nominal')
                            ->required()
                            ->prefix('Rp ')
                            ->numeric(),
                        Forms\Components\Select::make('tahun')
                            ->required()
                            ->options(
                                function () {
                                    $tahun = date('Y');
                                    $tahun = range(2000, $tahun);
                                    $tahun = array_reverse($tahun);
                                    return array_combine($tahun, $tahun);
                                }
                            )
                            ->searchable(),
                        Forms\Components\Select::make('sumber')
                            ->required()
                            ->native(false)
                            ->options([
                                'VA' => 'VA',
                                'Manual' => 'Manual',
                                'Transfer Bank' => 'Transfer Bank',
                            ]),
                        Forms\Components\TextInput::make('operator')
                            ->readOnly()
                            ->required()
                            ->default(auth()->user()->name),
                        FileUpload::make('foto_iuran')
                            ->columnSpanFull()
                            ->label('Foto Iuran')
                            ->disk('public')
                            ->directory('iurans')
                            ->image()
                            ->required()
                            ->maxSize(2048),
                        Forms\Components\Textarea::make('keterangan')
                            ->columnSpanFull()
                    ])
                    ->columns(2)
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make()
                    ->schema([
                        TextEntry::make('status')
                            ->badge()
                            ->color(function ($state) {
                                return match ($state) {
                                    'Disetujui' => 'success',
                                    'Ditolak' => 'danger',
                                    default => 'warning',
                                };
                            })
                            ->default('Diajukan')
                            ->inlineLabel()
                            ->label('Status'),
                        TextEntry::make('tahun')
                            ->inlineLabel()
                            ->label('Tahun'),
                        TextEntry::make('nominal')
                            ->inlineLabel()
                            ->label('Nominal')
                            ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                        TextEntry::make('sumber')
                            ->inlineLabel()
                            ->label('Sumber Iuran'),
                        TextEntry::make('created_at')
                            ->inlineLabel()
                            ->label('Tanggal Pengajuan'),
                        TextEntry::make('updated_at')
                            ->inlineLabel()
                            ->label('Tanggal Update'),
                        ImageEntry::make('foto_iuran_url')
                            ->label('Bukti Pembayaran')
                            ->size('w-full')
                            ->alignCenter()
                            ->url(fn($record) => $record->foto_iuran_url, true)
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull()
                    ->columns(),
                Section::make('Data Anggota')
                    ->schema([
                        TextEntry::make('anggota_nik')
                            ->label('NIK'),
                        TextEntry::make('nama')
                            ->label('Nama'),
                        TextEntry::make('dpc')
                            ->label('DPC'),
                    ])
                    ->columns(2),
                Section::make('Data Validator')
                    ->schema([
                        TextEntry::make('operator')
                            ->label('Operator')
                            ->default('-'),
                        TextEntry::make('keterangan')
                            ->label('Keterangan')
                            ->default('-')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                if (auth()->user()->is_admin == 'Super Admin') {
                    $query->where('dpc', auth()->user()->dpc);
                }
            })
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama'),
                Tables\Columns\TextColumn::make('status')
                    ->getStateUsing(function ($record) {
                        // Misal: data lama (dibuat sebelum 2025-03-01) dianggap sudah diverifikasi
                        if ($record->created_at < now()->createFromFormat('Y-m-d', '2025-03-01')) {
                            $record->status = 'Disetujui';
                            $record->save();
                            return 'Disetujui';
                        }
                        return $record->status; // untuk data baru (jika nanti diupdate)
                    })
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
                    ->getStateUsing(function ($record) {
                        if ($record->created_at < now()->createFromFormat('Y-m-d', '2025-03-01')) {
                            return 'done';
                        }
                        return $record->pesan;
                    })
                    ->label('Pesan')
                    ->wrap(),
                Tables\Columns\TextColumn::make('anggota_nik')
                    ->label('NIK'),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama'),
                Tables\Columns\TextColumn::make('nominal')
                    ->formatStateUsing(function ($state) {
                        return 'Rp. ' . number_format($state, 0, ',', '.');
                    })
                    ->label('Nominal'),
                Tables\Columns\TextColumn::make('tahun')
                    ->label('Tahun'),
                Tables\Columns\TextColumn::make('sumber'),
                Tables\Columns\TextColumn::make('dpc')
                    ->default('-'),
                Tables\Columns\TextColumn::make('operator')
                    ->default('-')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Pengajuan')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Tanggal Update')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([

                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('validasi')
                    ->label('Validasi')
                    ->icon('heroicon-o-check-circle')
                    ->modalHeading('Validasi Iuran')
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
                        $record->status = $data['status'];
                        $record->pesan = $data['pesan'];
                        $record->operator = auth()->user()->name;
                        $record->updated_at = now();
                        $record->save();

                        // Kirim notifikasi ke anggota
                        Notification::make()
                            ->title('Status iuran Anda telah diperbarui')
                            ->body($data['pesan'])
                            ->sendToDatabase(
                                User::where('nik', $record->nik)->first()
                            );

                        Notification::make()
                            ->title('Berhasil')
                            ->success()
                            ->send();
                    })
                    ->visible(function ($record) {
                        return $record->status == 'Diajukan' || $record->status == null;
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
            'index' => Pages\ListIurans::route('/'),
            'create' => Pages\CreateIuran::route('/create'),
            'view' => Pages\ViewIuran::route('/{record}'),
        ];
    }
}
