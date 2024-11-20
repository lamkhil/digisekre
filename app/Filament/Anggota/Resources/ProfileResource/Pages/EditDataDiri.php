<?php

namespace App\Filament\Anggota\Resources\ProfileResource\Pages;

use App\Filament\Anggota\Resources\ProfileResource;
use App\Models\WilayahDesa;
use App\Models\WilayahKabupaten;
use App\Models\WilayahKecamatan;
use App\Models\WilayahProvinsi;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EditDataDiri extends Page
{

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
                    ->numeric()
                    ->length(3),
                TextInput::make('rw')
                    ->inlineLabel()
                    ->label('RW')
                    ->numeric()
                    ->length(3),

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
