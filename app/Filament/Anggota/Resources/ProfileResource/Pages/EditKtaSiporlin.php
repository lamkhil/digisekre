<?php

namespace App\Filament\Anggota\Resources\ProfileResource\Pages;

use App\Filament\Anggota\Resources\ProfileResource;
use App\Models\Dpc;
use Filament\Resources\Pages\Page;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EditKtaSiporlin extends Page
{
    protected static string $resource = ProfileResource::class;

    protected static string $view = 'filament.anggota.resources.profile-resource.pages.edit-kta-siporlin';

    public ?array $data = [];

    public function mount()
    {
        $kartu = Auth::user()->kartu?->toArray() ?? [];
        $data = [];

        foreach ($kartu as $key => $value) {
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
                TextInput::make('nomor')
                    ->label('No. KTA')
                    ->required(),
                Select::make('bulan')
                    ->label('Bulan')
                    ->native(false)
                    ->options([
                        '01' => 'Januari',
                        '02' => 'Februari',
                        '03' => 'Maret',
                        '04' => 'April',
                        '05' => 'Mei',
                        '06' => 'Juni',
                        '07' => 'Juli',
                        '08' => 'Agustus',
                        '09' => 'September',
                        '10' => 'Oktober',
                        '11' => 'November',
                        '12' => 'Desember',
                    ]),
                Select::make('tahun')
                    ->label('Tahun')
                    ->searchable()
                    ->native(false)
                    ->options(function () {
                        $tahun = [];
                        for ($i = date('Y'); $i >= 2010; $i--) {
                            $tahun[$i] = $i;
                        }
                        return $tahun;
                    }),
                FileUpload::make('scan_kta')
                    ->label('Scan KTA')
                    ->required()

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
        try {
            DB::beginTransaction();
            /** @var \App\Models\User */
            $user = Auth::user();

            $user->kartu()->updateOrCreate([
                'nik' => $user->nik
            ], $data);
            DB::commit();
            Notification::make('success')
                ->title('Berhasil')
                ->body('Data kartu berhasil disimpan')
                ->success()
                ->send();
            return redirect()->route('filament.anggota.resources.profiles.kta-siporlin');
        } catch (\Throwable $th) {
            DB::rollBack();
            Notification::make('error')
                ->title('Gagal')
                ->body(config('app.debug') ? $th->getMessage() : 'Data kartu gagal disimpan')
                ->danger()
                ->send();
        }
    }
}
