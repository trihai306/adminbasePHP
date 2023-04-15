<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BankResource\Pages;
use App\Filament\Resources\BankResource\RelationManagers;
use App\Models\Bank;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BankResource extends Resource
{
    protected static ?string $model = Bank::class;

    protected static ?int $navigationSort = 9;

    protected static ?string $navigationIcon = 'heroicon-o-check-circle';

    protected static function getNavigationGroup(): ?string
    {
        return config('filament-user.group');
    }

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
                Forms\Components\Grid::make(4)->schema([
                    Forms\Components\Card::make()->schema([
                        Forms\Components\TextInput::make('bank_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('bank_number')

                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('user_name')

                            ->required()
                            ->maxLength(255),

                    ])->columnSpan(3),
                    Forms\Components\Card::make()->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'active' => 'Active',
                                'pending' => 'Pending',
                                'block' => 'Blocked',
                            ])->default('active')
                            ->required(),
                    ])->columnSpan(1)
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('bank_name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('bank_number')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user_name')
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('block')->label('Khóa')
                    ->icon('heroicon-o-x')
                    ->hidden(fn ($record) => in_array($record->status, ['block']))
                    ->action(function (Bank $record) {

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
                    })->color('danger'),

            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
            'index' => Pages\ListBanks::route('/'),
            'create' => Pages\CreateBank::route('/create'),
            'edit' => Pages\EditBank::route('/{record}/edit'),
        ];
    }
}
