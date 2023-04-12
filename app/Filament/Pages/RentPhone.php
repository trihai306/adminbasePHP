<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ApiKey;
use Filament\Pages\Page;

class RentPhone extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.demo';

    // protected function getHeaderWidgets(): array
    // {
    //     return [
    //         ApiKey::class
    //     ];
    // }
    protected function getHeaderWidgetsColumns(): int | array
    {
        return 1;
    }
}
