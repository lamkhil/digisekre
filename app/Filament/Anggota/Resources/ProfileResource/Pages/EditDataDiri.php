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
                    ->unique(
                        Anggota::class,
                        'nik',
                        Auth::user()->anggota
                    )
                    ->dehydrated(true)
                    ->minLength(16)
                    ->maxLength(16)
                    ->hint(fn($state, $component) => strlen($state) . '/'.$component->getMaxLength())
                    ->mask('9999999999999999')
                    ->disabled(
                        Auth::user()->nik != null
                    )
                    ->reactive()
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
                    ->options(function () {
                        return WilayahProvinsi::pluck('nama', 'id');
                    })
                    ->searchable()
                    ->required()
                    ->afterStateUpdated(function ($set) {
                        $set('kab', null);
                        $set('kec', null);
                        $set('desa_kel', null);
                    })
                    ->live(debounce: 500),
                Select::make('kab')
                    ->label('Kabupaten')
                    ->options(function ($get) {
                        return WilayahKabupaten::where('provinsi_id', $get('provinsi'))->pluck('nama', 'id');
                    })
                    ->disabled(fn($get) => $get('provinsi') == null)
                    ->searchable()
                    ->required()
                    ->afterStateUpdated(function ($set) {
                        $set('kec', null);
                        $set('desa_kel', null);
                    })
                    ->live(debounce: 500),
                Select::make('kec')
                    ->label('Kecamatan')
                    ->options(function ($get) {
                        return WilayahKecamatan::where('kabupaten_id', $get('kab'))->pluck('nama', 'id');
                    })
                    ->disabled(fn($get) => $get('kab') == null)
                    ->searchable()
                    ->required()
                    ->afterStateUpdated(function ($set) {
                        $set('desa_kel', null);
                    })
                    ->live(debounce: 500),
                Select::make('desa_kel')
                    ->required()
                    ->label('Kelurahan/Desa')
                    ->disabled(fn($get) => $get('kec') == null)
                    ->options(function ($get) {
                        return WilayahDesa::where('kecamatan_id', $get('kec'))->pluck('nama', 'id');
                    })
                    ->searchable()
                    ->live(debounce: 500),

                FileUpload::make('ktp')
                    ->label('Upload Ktp'),
                FileUpload::make('foto')
                    ->label('Upload Foto Diri')
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
            $provinsi = WilayahProvinsi::find($data['provinsi'])?->nama;
            $kab = WilayahKabupaten::find($data['kab'])?->nama;
            $kec = WilayahKecamatan::find($data['kec'])?->nama;
            $desaKel = WilayahDesa::find($data['desa_kel'])?->nama;
            $user->nik = $data['nik'];
            $user->name = $data['nama'];
            if ($provinsi != null) {
                $data['provinsi'] = $provinsi;
            }
            if ($kab != null) {
                $data['kab'] = $kab;
            }
            if ($kec != null) {
                $data['kec'] = $kec;
            }
            if ($desaKel != null) {
                $data['desa_kel'] = $desaKel;
            }
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
