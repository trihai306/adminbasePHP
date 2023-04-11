<?php

namespace App\Filament\Resources\SmshistoryResource\Pages;

use App\Filament\Resources\SmshistoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSmshistory extends EditRecord
{
    protected static string $resource = SmshistoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
