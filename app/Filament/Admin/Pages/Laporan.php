<?php

namespace App\Filament\Admin\Pages;

use App\Filament\Admin\Widgets\DpcChart;
use App\Filament\Admin\Widgets\DpcTableWidget;
use Filament\Pages\Page;

class Laporan extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.admin.pages.laporan';

    protected static ?string $navigationGroup = 'Umum';

    public function getHeaderWidgets(): array
    {
        return [
            DpcChart::make(),
            DpcTableWidget::make(),
        ];
    }
}
