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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class EditStr extends Page
{
    protected static string $resource = ProfileResource::class;

    protected static string $view = 'filament.anggota.resources.profile-resource.pages.edit-str';

    public ?array $data = [];

    public function mount()
    {
        if (Auth::user()->nik == null) {
            Notification::make('error')
                ->title('Gagal')
                ->body('Lengkapi data diri Anda terlebih dahulu')
                ->danger()
                ->send();
            return redirect()->route('filament.anggota.resources.profiles.data-diri');
        }
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
                TextInput::make('no_str')
                    ->label('Nomor STR')
                    ->required(),
                TextInput::make('no_serkom')
                    ->label('Nomor Serkom')
                    ->required(),
                DatePicker::make('tanggal_terbit'),
                DatePicker::make('tanggal_berakhir'),
                FileUpload::make('scan_str')
                    ->required()
                    ->label('Scan STR')
            ])->statePath('data');
    }

    public function save()
    {
        return Action::make('save')
            ->requiresConfirmation()
            ->label('Simpan')
            ->action(function () {
                $this->saveData();
            });
    }

    public function cancel()
    {
        return Action::make('cancel')
            ->requiresConfirmation()
            ->label('Batal')
            ->outlined()
            ->action(function () {
                return redirect()->route('filament.anggota.resources.profiles.str');
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
            $str = Auth::user()->str;
            if ($str) {
                $str->update($data);
            } else {
                $data['nik'] = $user->nik;
                $user->str()->create($data);
            }
            DB::commit();
            Notification::make('success')
                ->title('Berhasil')
                ->body('Data STR Anda berhasil disimpan')
                ->success()
                ->send();
            return redirect()->route('filament.anggota.resources.profiles.str');
        } catch (\Throwable $th) {
            DB::rollBack();
            Notification::make('error')
                ->title('Gagal')
                ->body('Data STR Anda gagal disimpan')
                ->danger()
                ->send();
        }
    }
}
