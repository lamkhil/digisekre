<?php

namespace App\Filament\Anggota\Resources\ProfileResource\Pages;

use App\Filament\Anggota\Resources\ProfileResource;
use App\Models\Anggota;
use App\Models\WilayahDesa;
use App\Models\WilayahKabupaten;
use App\Models\WilayahKecamatan;
use App\Models\WilayahProvinsi;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Facades\Filament;
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
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EditDataDiri extends Page
{
    use InteractsWithActions;

    protected static string $resource = ProfileResource::class;

    protected static string $view = 'filament.anggota.resources.profile-resource.pages.edit-data-diri';


    public ?array $data = [];

    public function mount()
    {
        $anggota = Auth::user()->anggota?->toArray() ?? [];
        $data = [];

        foreach ($anggota as $key => $value) {
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
                    ->numeric()
                    ->disabled(function () {
                        return Auth::user()->nik != null;
                    })
                    ->unique(
                        Anggota::class,
                        'nik',
                        Auth::user()->anggota
                    )
                    ->length(16)
                    ->required(),
                TextInput::make('nama')->required(),
                TextInput::make('tempat_lahir')->label('Tempat Lahir'),
                DatePicker::make('tanggal_lahir')->label('Tanggal Lahir')
                    ->native(false)
                    ->displayFormat('Y F d')
                    ->locale('id'),
                Radio::make('jk')
                    ->label('Jenis Kelamin')
                    ->inline()
                    ->inlineLabel(false)
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ]),
                Select::make('gd')
                    ->label('Golongan Darah')
                    ->options([
                        'A' => 'A',
                        'B' => 'B',
                        'AB' => 'AB',
                        'O' => 'O',
                    ]),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'Kawin' => 'Kawin',
                        'Belum Kawin' => 'Belum Kawin',
                        'Cerai Hidup' => 'Cerai Hidup',
                        'Cerai Mati' => 'Cerai Mati',
                    ]),
                TextInput::make('pekerjaan')
                    ->required()
                    ->label('Pekerjaan'),
                Select::make('agama')
                    ->label('Agama')
                    ->searchable()
                    ->options([
                        'Islam' => 'Islam',
                        'Kristen' => 'Kristen',
                        'Katolik' => 'Katolik',
                        'Hindu' => 'Hindu',
                        'Budha' => 'Budha',
                        'Konghucu' => 'Konghucu',
                    ]),
                Textarea::make('alamat')
                    ->autosize(),
                TextInput::make('rt')
                    ->inlineLabel()
                    ->label('RT')
                    ->numeric(),
                TextInput::make('rw')
                    ->inlineLabel()
                    ->label('RW')
                    ->numeric(),

                Select::make('provinsi')
                    ->label('Provinsi')
                    ->options(WilayahProvinsi::pluck('nama', 'id'))
                    ->searchable(),

                Select::make('kab')
                    ->label('Kabupaten')
                    ->options(fn(callable $get) => WilayahKabupaten::where('provinsi_id', $get('provinsi'))->pluck('nama', 'id'))
                    ->searchable()
                    ->disabled(fn(callable $get) => !$get('provinsi')),

                Select::make('kec')
                    ->label('Kecamatan')
                    ->options(fn(callable $get) => WilayahKecamatan::where('kabupaten_id', $get('kab'))->pluck('nama', 'id'))
                    ->searchable()
                    ->disabled(fn(callable $get) => !$get('kab')),

                Select::make('desa_kel')
                    ->label('Kelurahan')
                    ->options(fn(callable $get) => WilayahDesa::where('kecamatan_id', $get('kec'))->pluck('nama', 'id'))
                    ->searchable()
                    ->disabled(fn(callable $get) => !$get('kec')),
                FileUpload::make('ktp')
                    ->label('Upload Ktp'),
                FileUpload::make('foto')
                    ->label('Upload Foto')
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
                return redirect()->route('filament.anggota.resources.profiles.index');
            });
    }

    public function saveData()
    {
        $data = $this->form->getState();



        try {
            DB::beginTransaction();
            /** @var App\Models\User | null */
            $user = Filament::auth()->user();

            if ($user->nik == null) {
                Anggota::create($data);
            } else {
                Anggota::where('nik', $user->nik)->update($data);
            }
            $user->nik = $data['nik'];
            $user->name = $data['nama'];
            $user->save();

            Notification::make('success')
                ->title('Berhasil')
                ->body('Data diri Anda berhasil disimpan')
                ->success()
                ->send();
            DB::commit();
            return redirect()->route('filament.anggota.resources.profiles.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Notification::make('error')
                ->title('Gagal')
                ->body($th->getMessage())
                ->danger()
                ->send();
        }
    }
}
