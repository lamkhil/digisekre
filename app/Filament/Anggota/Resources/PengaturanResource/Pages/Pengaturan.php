<?php

namespace App\Filament\Anggota\Resources\PengaturanResource\Pages;

use App\Filament\Anggota\Resources\PengaturanResource;
use Filament\Resources\Pages\Page;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
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

        $this->form->fill();
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
                    ->confirmed()
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
        $data = $this->form->getState();


        $user = Auth::user();
        // Verifikasi password saat ini
        if (!Hash::check($data['current_password'], $user->password)) {
            Notification::make('failed')
                ->title('Password saat ini tidak sesuai')
                ->body('Password saat ini yang Anda masukkan tidak sesuai dengan password yang terdaftar.')
                ->danger()
                ->send();
            return;
        }
        try {
            DB::beginTransaction();

            // Update password baru
            $user->password = Hash::make($data['password']); // bcrypt($data['password']);
            $user->save();

            DB::commit();

            Notification::make('success')
                ->title('Password berhasil diubah')
                ->body('Password Anda berhasil diubah.')
                ->success()
                ->send();
        } catch (\Throwable $th) {
            DB::rollBack();
            Notification::make('failed')
                ->title('Terjadi kesalahan')
                ->body('Terjadi kesalahan saat mengubah password Anda.')
                ->danger()
                ->send();
        }
    }
}
