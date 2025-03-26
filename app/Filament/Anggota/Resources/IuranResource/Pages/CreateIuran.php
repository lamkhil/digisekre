<?php

namespace App\Filament\Anggota\Resources\IuranResource\Pages;

use App\Filament\Anggota\Resources\IuranResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;

class CreateIuran extends CreateRecord
{
    protected static string $resource = IuranResource::class;

    public function afterCreate():void
    {
        Notification::make('notify-admin')
            ->title('Pengajuan Iuran')
            ->body('Pengajuan Iuran telah diajukan oleh ' . auth()->user()->name)
            ->info()
            ->actions([
                Action::make('Lihat Iuran')
                    ->icon('heroicon-o-eye')
                    ->url(
                        url('admin/iuran/' . $this->record->id)
                    )
            ])
            ->sendToDatabase(
                User::where('is_admin','Admin')
                    ->where('dpc', $this->record->dpc)->get()
            );
    }
}
