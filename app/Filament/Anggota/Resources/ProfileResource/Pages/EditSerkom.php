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
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EditSerkom extends Page
{
    protected static string $resource = ProfileResource::class;

    protected static string $view = 'filament.anggota.resources.profile-resource.pages.edit-serkom';

    public ?array $data = [];

    public function mount()
    {
        $serkom = Auth::user()->serkom?->toArray() ?? [];
        $data = [];

        foreach ($serkom as $key => $value) {
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
                TextInput::make('no_serkom')
                    ->required(),
                DatePicker::make('tanggal_terbit'),
                FileUpload::make('scan_serkom')->required()
            ])->statePath('data');
    }

    public function save()
    {
        return Action::make('save')
            ->requiresConfirmation()
            ->label('Simpan')
            ->action('saveData');
    }

    public function cancel()
    {
        return Action::make('cancel')
            ->requiresConfirmation()
            ->color(Color::Red)
            ->label('Batal')
            ->outlined()
            ->action(function () {
                return redirect()->route('filament.anggota.resources.profiles.serkom');
            });
    }

    public function saveData()
    {
        $data = $this->form->getState();

        // Lanjutkan logic untuk menyimpan data di Model Anggota atau User, lakukan logic didalam transaction
        try {
            DB::beginTransaction();
            /** @var \App\Models\User */
            $user = Auth::user();
            $serkom = $user->serkom;
            if ($serkom) {
                $serkom->update($data);
            } else {
                $data['nik'] = $user->nik;
                $user->serkom()->create($data);
            }
            DB::commit();
            Notification::make('berhasil')
                ->title('Data berhasil disimpan')
                ->body('Data Serkom berhasil disimpan')
                ->success()
                ->send();
            return redirect()->route('filament.anggota.resources.profiles.serkom');
        } catch (\Throwable $th) {
            DB::rollBack();
            Notification::make('gagal')
                ->title('Data gagal disimpan')
                ->body('Data Serkom gagal disimpan')
                ->danger()
                ->send();
        }
    }
}
