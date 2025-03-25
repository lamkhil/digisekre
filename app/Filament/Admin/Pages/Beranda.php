<?php

namespace App\Filament\Admin\Pages;

use App\Filament\Admin\Widgets\DpcChart;
use App\Filament\Admin\Widgets\DpcTableWidget;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class Beranda extends Page
{
    protected static string $view = 'filament.admin.pages.beranda';

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationLabel = "Beranda";

    protected static ?string $navigationGroup = 'Umum';

    protected static ?string $title = '';
    protected static ?int $navigationSort = -9;

    // Page Data
    
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    /**
     * @return array<class-string<Widget> | WidgetConfiguration>
     */
    protected function getFooterWidgets(): array
    {
        return [
            // DpcChart::make(),
            // DpcTableWidget::make(),
        ];
    }
}
