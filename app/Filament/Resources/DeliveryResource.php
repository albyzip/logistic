<?php

namespace App\Filament\Resources;

use App\Enums\PackagingUnit;
use App\Filament\Resources\DeliveryResource\Pages;
use App\Filament\Resources\DeliveryResource\RelationManagers\CargosRelationManager;
use App\Models\Delivery;
use App\Models\Warehouse;
use App\Traits\Naming;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DeliveryResource extends Resource
{
    use Naming;
    protected static ?string $model = Delivery::class;
    protected static ?string $name = 'Delivery';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Toggle::make('get_from_address')
                    ->columnSpan(12)
                    ->label(self::getFieldName('get_from_address'))
                    ->required(),
                Forms\Components\Select::make('from_warehouse_id')
                    ->columnSpan(6)
                    ->label(self::getFieldName('from_warehouse_id'))
                    ->options(Warehouse::query()->get()->pluck('name', 'id')),
                Forms\Components\Select::make('to_warehouse_id')
                    ->columnSpan(6)
                    ->label(self::getFieldName('to_warehouse_id'))
                    ->options(Warehouse::query()->get()->pluck('name', 'id')),
                Forms\Components\Textarea::make('comment')
                    ->label(self::getFieldName('comment'))
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('unload_at')
                    ->columnSpan(6)
                    ->label(self::getFieldName('unload_at')),
                Forms\Components\TextInput::make('price')
                    ->columnSpan(6)
                    ->label(self::getFieldName('price'))
                    ->numeric()
                    ->prefix('₽'),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('from_warehouse_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('to_warehouse_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('get_from_address')
                    ->boolean(),
                Tables\Columns\TextColumn::make('unload_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CargosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDeliveries::route('/'),
            'create' => Pages\CreateDelivery::route('/create'),
            'edit' => Pages\EditDelivery::route('/{record}/edit'),
        ];
    }
}
