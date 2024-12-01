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

class EditSumprof extends Page
{
    protected static string $resource = ProfileResource::class;

    protected static string $view = 'filament.anggota.resources.profile-resource.pages.edit-sumprof';

    public ?array $data = [];

    public function mount()
    {
        $sumprof = Auth::user()->sumprof?->toArray() ?? [];
        $data = [];

        foreach ($sumprof as $key => $value) {
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
                DatePicker::make('tanggal_sumprof'),
                FileUpload::make('scan_sumprof_1')
                    ->label('Scan Sumprof I')->required(),
                FileUpload::make('scan_sumprof_2')
                    ->label('Scan Sumprof II')->required(),
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
           /** @var \App\Models\User */
           $user = Auth::user();

           $user->sumprof()->updateOrCreate([
               'nik' => $user->nik
           ],$data);
           DB::commit();
           Notification::make('success')
               ->title('Berhasil')
               ->body('Data sumprof berhasil disimpan')
               ->success()
               ->send();
               return redirect()->route('filament.anggota.resources.profiles.sumprof');
       } catch (\Throwable $th) {
           DB::rollBack();
           Notification::make('error')
               ->title('Gagal')
               ->body(config('app.debug') ? $th->getMessage():'Data sumprof gagal disimpan')
               ->danger()
               ->send();
       }
    }
}
