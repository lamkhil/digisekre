<?php

namespace App\Filament\Admin\Resources\RekomendasiSikResource\Pages;
use App\Filament\Admin\Resources\RekomendasiSikResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms;

class ViewRekomendasiSik extends ViewRecord
{
    protected static string $resource = RekomendasiSikResource::class;

    /**
     * @return array<Action | ActionGroup>
     */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('validasi')
                ->label('Validasi')
                ->icon('heroicon-o-check-circle')
                ->modalHeading('Validasi SIK')
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
                    $record->approveRekomendasiSik($data);
                })
                ->visible(function ($record) {
                    return $record->status == null;
                })
        ];
    }
}
