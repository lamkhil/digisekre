<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Dpc;
use App\Models\User;
use Illuminate\Support\Facades\DB as DB;

class DpcChart extends ChartWidget
{
    protected static ?string $heading = 'Laporan DPC ';

    protected function getData(): array
    {
        $dpcCounts = DB::table('dpcs')
        ->leftJoin('users', 'dpcs.nama_dpc', '=', 'users.dpc') // Pastikan kolom dpc_id ada di tabel users
        ->select('dpcs.nama_dpc',
         DB::raw('count(users.id) as user_count'))
        ->groupBy('dpcs.id','dpcs.nama_dpc')
        ->orderBy('dpcs.nama_dpc')
        ->get();

    return [
        'datasets' => [
            [
                'label' => 'Jumlah Users per DPC',
                'data' => $dpcCounts->pluck('user_count'), // Ambil jumlah pengguna
            ],
        ],
        'labels' => $dpcCounts->pluck('nama_dpc'), // Ambil nama DPC sebagai label
    ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
