<?php

namespace App\Filament\Anggota\Resources\ProfileResource\Pages;

use App\Filament\Anggota\Resources\ProfileResource;
use Filament\Resources\Pages\Page;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class EditStr extends Page
{
    protected static string $resource = ProfileResource::class;

    protected static string $view = 'filament.anggota.resources.profile-resource.pages.edit-str';

    public ?array $data = [];

    public function mount()
    {
        $str = Auth::user()->str?->toArray() ?? [];
        $data = [];

        foreach ($str as $key => $value) {
            $data[$key] = $value;
        }

        //tambahkan field yang tidak ada di model anggota jika diperlukan
        //$data['field'] = 'value';

        $this->form->fill($data);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nik')
                    ->label('NIK')
                    ->numeric()
                    ->length(16)
                    ->required(),
                TextInput::make('no_str')
                    ->required()
                    ->integer(),
                TextInput::make('no_serkom')
                    ->required()
                    ->integer(),
                DatePicker::make('tanggal_terbit'),
                DatePicker::make('tanggal_berakhir'),
                FileUpload::make('scan_str')->required()
            ])->statePath('data');
    }

    public function save()
    {
        return Action::make('save')
            ->label('Simpan')
            ->action('saveData');
    }

    public function cancel()
    {
        return Action::make('cancel')
            ->label('Batal')
            ->outlined()
            ->action(function () {
                return redirect()->route('filament.anggota.resources.profiles.index');
            });
    }

    public function saveData()
    {
        $data = $this->form->getState();

        // Lanjutkan logic untuk menyimpan data di Model Anggota atau User, lakukan logic didalam transaction
        try {
            DB::beginTransaction();
            // Simpan data ke Model Anggota atau User
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
