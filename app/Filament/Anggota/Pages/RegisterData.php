<?php

namespace App\Filament\Anggota\Pages;

use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Pages\Page;

class RegisterData extends Page
{
    use InteractsWithForms;


    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.anggota.pages.register-data';


    protected static string $layout = 'layouts.guest';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nik')
                    ->label('NIK')
                    ->required(),
                TextInput::make('nama')
                    ->label('Nama')
                    ->required(),

                TextInput::make('tempat_lahir')
                    ->label('Tempat Lahir')
                    ->required(),
                TextInput::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
                    ->type('date')
                    ->required(),
                Select::make('jk')
                    ->label('Jenis Kelamin')
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ])
                    ->required(),
                Select::make('agama')
                    ->label('Agama')
                    ->options([
                        'Islam' => 'Islam',
                        'Kristen' => 'Kristen',
                        'Katolik' => 'Katolik',
                        'Hindu' => 'Hindu',
                        'Budha' => 'Budha',
                        'Konghucu' => 'Konghucu',
                    ])
                    ->required(),
                Textarea::make('alamat')
                    ->label('Alamat')
                    ->required(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'Kawin' => 'Kawin',
                        'Belum Kawin' => 'Belum Kawin',
                        "Cerai Hidup" => "Cerai Hidup",
                        "Cerai Mati" => "Cerai Mati"
                    ])
                    ->required(),
            ])
            ->statePath('data');
    }
}
