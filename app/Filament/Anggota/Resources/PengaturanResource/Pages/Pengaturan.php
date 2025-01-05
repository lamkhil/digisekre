<?php

namespace App\Filament\Anggota\Resources\PengaturanResource\Pages;

use App\Filament\Anggota\Resources\PengaturanResource;
use Filament\Resources\Pages\Page;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Pengaturan extends Page
{
    protected static string $resource = PengaturanResource::class;

    protected static string $view = 'filament.anggota.resources.pengaturan-resource.pages.pengaturan';
    
    public ?array $data = [];

    public function mount()
    {
        $user = Auth::user();

        // Inisialisasi data dengan password hash
        $this->data['current_password'] = $user->password; 
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('current_password')
                ->label('Password Saat Ini')
                ->password()
                ->required()
                ->revealable(),

            TextInput::make('password')
                ->label('Password Baru')
                ->password()
                ->minLength(8)
                ->required()
                ->revealable(),

            TextInput::make('password_confirmation')
                ->label('Konfirmasi Password Baru')
                ->password()
                ->same('password')
                ->required()
                ->revealable(),
                
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
        $this->validate([
            'data.current_password' => 'required',
            'data.password' => 'required|min:8',
            'data.password_confirmation' => 'required|same:data.password',
        ]);

        $user = Auth::user();
        // Verifikasi password saat ini
        if (!Hash::check($this->data['current_password'], $user->password)) {
            
            return;
        }

        // Update password baru
        $user->password = Hash::make($this->data['new_password']);
        $user->save;
        
        try {
            DB::beginTransaction();
            // Simpan data ke Model Anggota atau User
            DB::commit();
            
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

}
