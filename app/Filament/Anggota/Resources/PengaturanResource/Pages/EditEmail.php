<?php

namespace App\Filament\Anggota\Resources\PengaturanResource\Pages;

use App\Filament\Anggota\Resources\PengaturanResource;
use Filament\Resources\Pages\Page;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EditEmail extends Page
{
    protected static string $resource = PengaturanResource::class;

    protected static string $view = 'filament.anggota.resources.pengaturan-resource.pages.edit-email';

    public ?array $data = [];

    public function mount()
    {
        $this->data['email'] = Auth::user()->email;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                ->label('Email')
                ->email()
                ->required(),
                
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

        $this->validate();

        $user = Auth::user();
        $user->email = $this->email;
       
        try {
            DB::beginTransaction();
           
            // Simpan data ke Model Anggota atau User
            DB::commit();
            $this->notify('success', 'Email berhasil diperbarui.');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
