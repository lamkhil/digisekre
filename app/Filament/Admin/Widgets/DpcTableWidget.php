<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Pengajuan; // Make sure to import your Pengajuan model
use App\Models\Dpc;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;


class DpcTableWidget extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
        ->query(
            Pengajuan::select('pengajuans.dpc', 'pengajuans.pengaju')
            ->leftJoin('dpcs', 'dpcs.nama_dpc', '=', 'pengajuans.dpc')
            ->selectRaw('COUNT(pengajuans.pengaju) as record_count')
            ->selectRaw("DATE_FORMAT(MAX(pengajuans.created_at), '%Y-%m-%d') as created_at") 
            ->groupBy('pengajuans.dpc', 'pengajuans.pengaju')
            ->orderBy('pengajuans.dpc')

        )
        ->columns([
            Tables\Columns\TextColumn::make('dpc')
            ->label('DPC')
            ->sortable(),
            Tables\Columns\TextColumn::make('pengaju')
                ->label('Pengaju')
                ->sortable(),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Tanggal Pembuatan')
                ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->format('Y-m-d')) // Format the date
                ->sortable(),
            Tables\Columns\TextColumn::make('record_count')
                ->label('Jumlah Record')
                ->sortable(),
        ]);
    }
    function getTableRecordKey($record): string
    {
        return (string) $record->nama_dpc; // Return the unique identifier as a string
    }
}
