<?php

namespace App\Filament\Anggota\Resources\MutasiResource\Pages;

use App\Filament\Admin\Resources\MutasiResource\Pages\EditMutasi as AdminEditMutasi;
use App\Filament\Anggota\Resources\MutasiResource;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateMutasi extends CreateRecord
{
    protected static string $resource = MutasiResource::class;


    protected static ?string $title = "Ajukan Mutasi";

    public function afterCreate():void
    {
        Notification::make('notify-admin')
            ->title('Pengajuan Mutasi')
            ->body('Pengajuan Mutasi telah diajukan oleh ' . auth()->user()->name)
            ->info()
            ->actions([
                Action::make('Lihat Mutasi')
                    ->icon('heroicon-o-eye')
                    ->url(
                        url('admin/mutasi/' . $this->record->id)
                    )
            ])
            ->sendToDatabase(
                User::where('is_admin','Admin')
                    ->where('dpc', $this->record->dpc)->get()
            );
    }
}
