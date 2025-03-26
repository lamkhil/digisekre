<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AdminResource\Pages;
use App\Filament\Admin\Resources\AdminResource\RelationManagers;
use App\Models\Dpc;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class AdminResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Admin';

    protected static ?string $navigationGroup = 'Manajemen';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Admin';

    protected static ?string $breadcrumb = "Admin";

    public static function canAccess(): bool
    {
            $user = auth()->user();
            return $user && $user->is_admin == 'Super Admin';
    }

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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('is_admin', 'Admin');
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
            'index' => Pages\ListAdmins::route('/'),
            'create' => Pages\CreateAdmin::route('/create'),
            'edit' => Pages\EditAdmin::route('/{record}/edit'),
        ];
    }
}
