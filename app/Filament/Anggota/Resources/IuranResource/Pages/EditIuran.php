<?php

namespace App\Filament\Anggota\Resources\IuranResource\Pages;

use App\Filament\Anggota\Resources\IuranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIuran extends EditRecord
{
    protected static string $resource = IuranResource::class;

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
            $this->redirect(ViewIuran::getUrl([
                'record' => $this->record,
            ]));
        }
    }
}
