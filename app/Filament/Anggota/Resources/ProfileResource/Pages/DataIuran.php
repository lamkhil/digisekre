<?php

namespace App\Filament\Anggota\Resources\ProfileResource\Pages;

use App\Filament\Anggota\Resources\ProfileResource;
use App\Filament\Anggota\Resources\ProfileResource\Components\LayoutProfile;
use App\Models\Iuran;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Resources\Pages\Page;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class DataIuran extends LayoutProfile implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected static string $resource = ProfileResource::class;

    protected static string $view = 'filament.anggota.resources.profile-resource.pages.data-iuran';

    public $iuran;

    public function mount() : void
    {
        $this->iuran = Auth::user()->iuran;

        parent::mount();
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Data Iuran')
            ->query(Iuran::where('anggota_nik', Auth::user()->nik))
            ->headerActions([
                // Action::make('add')
                //     ->label('Tambah Data Iuran')
                //     ->form(function ($form) {
                //         return$form->schema([
                //             TextInput::make('nama')
                //                 ->default(
                //                     Auth::user()->nama
                //                 )
                //                 ->required(),
                //             TextInput::make('nominal')
                //                 ->required()
                //                 ->numeric(),

                //         ]);
                //     })
                //     ->action(function ($data) {})
            ])
            ->columns([
                TextColumn::make('anggota_nik')
                    ->label('NIK'),
                TextColumn::make('nama')
                    ->label('Nama'),
                TextColumn::make('nominal')
                    ->formatStateUsing(function ($state) {
                        return 'Rp. ' . number_format($state, 0, ',', '.');
                    })
                    ->label('Nominal'),
                TextColumn::make('tahun')
                    ->label('Tahun'),
                TextColumn::make('sumber'),
                TextColumn::make('dpc')
                    ->default('-'),
                TextColumn::make('operator')
                    ->default('-'),
            ])
            ->filters([
                //
            ])
            ->actions([])
            ->bulkActions([]);
    }
}
