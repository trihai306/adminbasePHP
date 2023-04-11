<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Closure;
use Filament\Tables;
use Filament\Tables\Actions\Action;

use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;

class ApiKey extends BaseWidget
{
    protected function getTableQuery(): Builder
    {
     return User::query()->latest();
    }
    //tạo column
    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('id'),
            Tables\Columns\TextColumn::make('name'),
        ];
    }
    //tạo button ở column
    public function getTableActions(): array
    {
        return [
            Action::make('delete')
                ->label('Delete api')
                ->icon('heroicon-o-trash')
                ->color('danger'),
                Action::make('edit')
                ->label('Edit api')
                ->color('warning')
                ->icon('heroicon-o-pencil')
        ];
    }

   
    //tạo bluk action
    protected function getTableBulkActions(): array
    {
        return [
            BulkAction::make('delete')
                ->deselectRecordsAfterCompletion()
                ->color('danger')
                ->icon('heroicon-o-trash')
        ];
    }

    //tạo action trên header
    protected function getTableHeaderActions(): array
    {
        return [
            Action::make('create')
                ->label('Create API key')
                ->button()
                ->icon('heroicon-s-plus')
            ->action(function () {
                $this->update();
            }),
        ];
    }
    public function update(): void
    {
        $this->emit('refresh');
    }
}
