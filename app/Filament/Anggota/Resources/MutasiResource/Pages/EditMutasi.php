<?php

namespace App\Filament\Anggota\Resources\MutasiResource\Pages;

use App\Filament\Anggota\Resources\MutasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMutasi extends EditRecord
{
    protected static string $resource = MutasiResource::class;

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
            $this->redirect(ViewMutasi::getUrl([
                'record' => $this->record,
            ]));
        }
    }


    protected static ?string $title = "Edit Mutasi";
}
