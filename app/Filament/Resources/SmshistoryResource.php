<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SmshistoryResource\Pages;
use App\Filament\Resources\SmshistoryResource\RelationManagers;
use App\Models\smsHistory;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SmshistoryResource extends Resource
{
    protected static ?string $model = smsHistory::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any',
            'publish'
        ];
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('id')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('phone')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('code')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('sms')
                ->sortable()
                ->searchable(),
            Tables\Columns\BadgeColumn::make('status')->enum([
                'active' => 'Active',
                'pending' => 'Pending',
                'block' => 'Blocked',
            ])->colors([
                'success' => 'active',
                'warning' => 'pending',
                'danger' => 'block',
            ])->searchable()->sortable(),
            Tables\Columns\TextColumn::make('created_at')
                ->sortable()
                ->searchable(),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\Action::make('duyet')->label('Duyệt')
            ->icon('heroicon-o-check')
            ->hidden(fn($record) => in_array($record->status, ['active']))
            ->action(function (smsHistory $record) {
                if ($record->status == 'active') {
                    Notification::make()
                        ->title('Cập nhập thất bại')
                        ->danger()
                        ->body('Giao dịch đã được duyệt')
                        ->send();
                    return;
                }
                if ($record->type == 'deposit') {
                    $record->member->money += $record->money;
                    $record->member->save();
                }
                $record->status = 'active';
                $record->save();
                Notification::make()
                    ->title('Cập nhập thành công')
                    ->success()
                    ->body('Giao dịch đã được duyệt')
                    ->send();
            })->button()->color('success'),
            Tables\Actions\Action::make('block')->label('Khóa')
                ->icon('heroicon-o-x')
                ->hidden(fn ($record) => in_array($record->status, ['block']))
                ->action(function (smsHistory $record) {

                    if ($record->status == 'block') {
                        Notification::make()
                            ->title('Cập nhập thất bại')
                            ->danger()
                            ->body('Service đã bị khóa')
                            ->send();
                        return;
                    }
                    if ($record->status == 'active') {
                        if ($record->type == 'deposit') {
                            $record->member->money -= $record->money;
                            $record->member->save();
                        }
                    }
                    $record->status = 'block';
                    $record->save();
                    Notification::make()
                        ->title('Cập nhập thành công')
                        ->success()
                        ->body('Service đã bị khóa')
                        ->send();
                })->button()->color('danger'),

        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
      
    }

    public static function canEdit(Model $record): bool
    {
        return false; // TODO: Change the autogenerated stub
    }

    public static function canCreate(): bool
    {
        return false; // TODO: Change the autogenerated stub
    }

    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }


    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSmshistories::route('/'),
            'create' => Pages\CreateSmshistory::route('/create'),
            'edit' => Pages\EditSmshistory::route('/{record}/edit'),
        ];
    }    
}
