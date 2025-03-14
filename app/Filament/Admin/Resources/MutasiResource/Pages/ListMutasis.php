<?php

namespace App\Filament\Admin\Resources\MutasiResource\Pages;

use App\Filament\Admin\Resources\MutasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;

class ListMutasis extends ListRecords
{
    protected static string $resource = MutasiResource::class; 

    public function getTitle(): string | Htmlable
    {
        if (Auth::user()->is_admin == 'Admin') {
            return 'List Mutasi DPC '.Auth::user()->dpc;
        }
        return 'List Mutasi';
    }

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
