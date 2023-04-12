<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionsResource\Pages;
use App\Filament\Resources\TransactionsResource\RelationManagers;

use App\Models\Transactions;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;

class TransactionsResource extends Resource
{
    protected static ?string $model = Transactions::class;

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
                Forms\Components\Grid::make(4)->schema([
                    Forms\Components\Card::make()->schema([
                        Forms\Components\TextInput::make('member_id')
                            ->numeric()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('money')
                            ->numeric()
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
                        Forms\Components\Select::make('type')
                            ->options([
                                'deposit' => 'Nạp Tiền',
                                'withdrawals' => 'Rút Tiền',
                            ])->default('Nạp Tiền')
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
                Tables\Columns\TextColumn::make('member_id')
                    ->label('User id')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('money')
                ->money('vnd')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('bank.bank_name')
                ->label('Bank name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('bank.bank_number')
                ->label('Bank number')
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
                    ->hidden(fn ($record) => in_array($record->status, ['active']))
                    ->action(function (Transactions $record) {
                        if ($record->status == 'active') {
                            Notification::make()
                                ->title('Cập nhập thất bại')
                                ->danger()
                                ->body('Giao dịch đã được duyệt')
                                ->send();
                            return;
                        }
                        if ($record->type == 'deposit') {
                            $record->user->money += $record->money;
                            $record->user->save();
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
                    ->action(function (Transactions $record) {

                        if ($record->status == 'block') {
                            Notification::make()
                                ->title('Cập nhập thất bại')
                                ->danger()
                                ->body('Giao dịch đã bị khóa')
                                ->send();
                            return;
                        }
                        if ($record->status == 'active') {
                            if ($record->type == 'deposit') {
                                $record->user->money -= $record->money;
                                $record->user->save();
                            }
                        }
                        $record->status = 'block';
                        $record->save();
                        Notification::make()
                            ->title('Cập nhập thành công')
                            ->success()
                            ->body('Giao dịch đã bị khóa')
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransactions::route('/create'),
            'edit' => Pages\EditTransactions::route('/{record}/edit'),
        ];
    }
}
