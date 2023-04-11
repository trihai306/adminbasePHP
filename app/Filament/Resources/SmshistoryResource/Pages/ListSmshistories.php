<?php

namespace App\Filament\Resources\SmshistoryResource\Pages;

use App\Filament\Resources\SmshistoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSmshistories extends ListRecords
{
    protected static string $resource = SmshistoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
