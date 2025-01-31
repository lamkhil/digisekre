<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\IuranResource\Pages;
use App\Filament\Admin\Resources\IuranResource\RelationManagers;
use App\Models\Dpc;
use App\Models\Iuran;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                            ->when(auth()->user()->is_admin == 'Admin', function ($query) {
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
                    ->afterStateUpdated(function($state,$set){
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
                Forms\Components\Select::make('Tahun')
                ->required()
                    ->options(
                        function(){
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
                Forms\Components\Textarea::make('keterangan')
                ->columnSpanFull()
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                if (auth()->user()->is_admin == 'Admin') {
                    $query->where('dpc', auth()->user()->dpc);
                }
            })
            ->defaultSort('updated_at', 'desc')
            ->columns([
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
            'index' => Pages\ListIurans::route('/'),
            'create' => Pages\CreateIuran::route('/create'),
            'edit' => Pages\EditIuran::route('/{record}/edit'),
        ];
    }
}
