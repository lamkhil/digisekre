<?php

namespace App\Filament\Anggota\Resources\RekomendasiResource\Pages;

use App\Filament\Anggota\Resources\RekomendasiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;
use App\Models\User;

class CreateRekomendasi extends CreateRecord
{
    protected static string $resource = RekomendasiResource::class;


    protected static ?string $title = "Ajukan Rekomendasi SIK";

    public function afterCreate():void
    {
        Notification::make('notify-admin')
            ->title('Pengajuan Rekomendasi SIK')
            ->body('Pengajuan Rekomendasi SIK telah diajukan oleh ' . auth()->user()->name)
            ->info()
            ->actions([
                Action::make('Lihat Rekomendasi')
                    ->icon('heroicon-o-eye')
                    ->url(
                        url('admin/rekomendasi/' . $this->record->id)
                    )
            ])
            ->sendToDatabase(
                User::where('is_admin','Admin')
                    ->where('dpc', $this->record->dpc)->get()
            );
    }
}
