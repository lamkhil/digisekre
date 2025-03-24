<?php

namespace App\Livewire;

use Livewire\Component;

use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;

class AvatarUploader extends Component implements HasForms
{
    use InteractsWithForms;

    public $profilePath;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'profile' => Auth::user()->anggota?->foto,
        ]);

        $this->profilePath = Auth::user()->anggota?->foto;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('profile')
                    ->label('')
                    ->avatar()
                    ->live()
                    ->directory('anggota/foto/'.(Auth::user()->anggota?->nik ?? ''))
                    ->disk('public'),
                Actions::make([
                    Action::make('save')
                        ->label('Simpan')
                        ->action(function () {
                            $this->save();
                        })
                        ->disabled(function($get){
                            if (!isset(array_values($get('profile'))[0])) {
                                return true;
                            }
                            if (array_values($get('profile'))[0] == $this->profilePath) {
                                return true;
                            }
                            return false;
                        })
                        ->extraAttributes([
                            'class' => 'mx-auto',
                        ])
                ])->columnSpanFull()
                    ->columns(1)
            ])
            ->statePath('data');
    }

    public function save(): void
    {

        $data  = $this->form->getState();

        Auth::user()->anggota->update([
            'foto' => $data['profile'],
        ]);

        $this->redirect(route('filament.anggota.resources.profiles.index'));
    }

    public function render()
    {
        return view('livewire.avatar-uploader');
    }
}
