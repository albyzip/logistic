<?php

namespace App\Filament\Resources;

use App\Enums\CityClassifier;
use App\Enums\SupplyType;
use App\Models\AdditionalService;
use App\Traits\Naming;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables;
use App\Filament\Resources\AdditionalServiceResource\Pages;

class AdditionalServiceResource extends Resource
{
    use Naming;
    protected static ?string $model = AdditionalService::class;
    protected static ?string $name = 'AdditionalService';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Название')
                    ->columnSpan(12)
                    ->required(),
                TextInput::make('price')
                    ->label('Цена')
                    ->columnSpan(12)
                    ->required(),
                Select::make('supply_type')
                    ->label('Тип поставки')
                    ->columnSpan(6)
                    ->options(SupplyType::forSelect()),
                Select::make('city_classifier')
                    ->label('Классификатор города')
                    ->columnSpan(6)
                    ->options(CityClassifier::forSelect())
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('city_classifier')
                    ->getStateUsing(function ($record) {
                        return $record->city_classifier->value;
                    })
                    ->numeric()
                    ->sortable(),
                TextColumn::make('supply_type')
                    ->getStateUsing(function ($record) {
                        return SupplyType::getName($record->supply_type);
                    })
                    ->numeric()
                    ->sortable(),
                TextColumn::make('name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('price')
                    ->numeric()
                    ->sortable(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdditionalService::route('/'),
            'create' => Pages\CreateAdditionalService::route('/create'),
            'edit' => Pages\EditAdditionalService::route('/{record}/edit'),
        ];
    }
}
