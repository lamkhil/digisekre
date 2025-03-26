<?php

namespace App\Filament\Anggota\Resources\RekomendasiResource\Pages;

use App\Filament\Anggota\Resources\RekomendasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRekomendasi extends EditRecord
{
    protected static string $resource = RekomendasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);

        $this->authorizeAccess();

        $this->fillForm();

        $this->previousUrl = url()->previous();

        if ($this->record->status == 'Disetujui' || $this->record->status == 'Ditolak') {
            $this->redirect(ViewRekomendasi::getUrl([
                'record' => $this->record,
            ]));
        }
    }
}
