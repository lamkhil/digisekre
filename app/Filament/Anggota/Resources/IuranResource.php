<?php

namespace App\Filament\Anggota\Resources;

use App\Filament\Anggota\Resources\IuranResource\Pages;
use App\Filament\Anggota\Resources\IuranResource\RelationManagers;
use App\Models\Iuran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;

class IuranResource extends Resource
{
    protected static ?string $model = Iuran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $breadcrumb = "Iuran";

    protected static ?string $navigationLabel = 'Iuran';

    protected static ?string $navigationGroup = 'Pengajuan';

    protected static ?int $navigationSort = 2;

    public $foto_iuran;

    public static function form(Form $form): Form
    {
        return $form
                ->schema([
                    Forms\Components\TextInput::make('anggota_nik')
                ->label('NIK')
                ->required()
                ->default(Filament::auth()->user()->nik),
                
            Forms\Components\TextInput::make('nama')
            ->default(Filament::auth()->user()->name),
            Forms\Components\TextInput::make('dpc')
            ->label('DPC')
            ->default(Filament::auth()->user()->dpc),
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
            FileUpload::make('foto_iuran')
            ->columnSpanFull()
            ->label('Foto Iuran')
            ->disk('public') 
            ->directory('iurans')
            ->image() 
            ->required()
            ->maxSize(2048)
            ]);
        
        }


    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('anggota_nik', auth()->user()->nik);
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
                Tables\Columns\ImageColumn::make('foto_iuran')
                    ->label('Foto Iuran')
                    ->disk('public'),
            ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
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
