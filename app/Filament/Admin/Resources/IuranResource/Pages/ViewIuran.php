<?php

namespace App\Filament\Admin\Resources\IuranResource\Pages;

use App\Filament\Admin\Resources\IuranResource;
use App\Models\User;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms;
use Filament\Notifications\Notification;

class ViewIuran extends ViewRecord
{
    protected static string $resource = IuranResource::class;

    public function getHeaderActions(): array
    {
        return [
            Action::make('validasi')
                    ->label('Validasi')
                    ->icon('heroicon-o-check-circle')
                    ->modalHeading('Validasi Iuran')
                    ->form([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->native(false)
                            ->options([
                                'Disetujui' => 'Disetujui',
                                'Ditolak' => 'Ditolak'
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('pesan')
                            ->label('Pesan')
                            ->required()
                    ])
                    ->action(function ($record, $data) {
                        $record->status = $data['status'];
                        $record->keterangan = $data['pesan'];
                        $record->operator = auth()->user()->name;
                        $record->updated_at = now();
                        $record->save();

                        // Kirim notifikasi ke anggota
                        Notification::make()
                            ->title('Status iuran Anda telah diperbarui')
                            ->body($data['pesan'])
                            ->sendToDatabase(
                                User::where('nik', $record->nik)->first()
                            );

                        Notification::make()
                            ->title('Berhasil')
                            ->success()
                            ->send();
                    })
                    ->visible(function ($record) {
                        return $record->status == 'Diajukan' || $record->status == null;
                    }),
        ];
    }
}
