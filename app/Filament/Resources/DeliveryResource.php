<?php

namespace App\Filament\Resources;

use App\Enums\SupplyType;
use App\Filament\Resources\DeliveryResource\Fieldsets\DeliveryBoxFieldset;
use App\Filament\Resources\DeliveryResource\Fieldsets\PalletFieldset;
use App\Filament\Resources\DeliveryResource\Fieldsets\PersonalInformationFieldset;
use App\Filament\Resources\DeliveryResource\Pages;
use App\Filament\Resources\DeliveryResource\RelationManagers\CargosRelationManager;
use App\Models\City;
use App\Models\Delivery;
use App\Models\Warehouse;
use App\Traits\Naming;
use Closure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

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
                Forms\Components\Select::make('city_id')
                    ->label(self::getFieldName('city_id'))
                    ->columnSpan(6)
                    ->reactive()
                    ->options(City::query()->get()->pluck('name', 'id')),
                Forms\Components\Select::make('to_warehouse_id')
                    ->columnSpan(6)
                    ->label(self::getFieldName('to_warehouse_id'))
                    ->multiple()
                    ->options(Warehouse::query()->get()->pluck('name', 'id')),
                self::deliverySection(),
                PersonalInformationFieldset::get('Персональная информация'),
                Forms\Components\Textarea::make('comment')
                    ->label(self::getFieldName('comment'))
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('price')
                    ->columnSpan(6)
                    ->label(self::getFieldName('price'))
                    ->numeric()
                    ->prefix('₽'),
                Forms\Components\DateTimePicker::make('unload_at')
                    ->columnSpan(6)
                    ->label(self::getFieldName('unload_at')),
            ])->columns(12);
    }

    protected static function deliverySection(): Forms\Components\Section
    {
        return Forms\Components\Section::make(self::getTranslation('delivery_section'))
            ->description(self::getTranslation('delivery_section_description'))
            ->schema([
                Forms\Components\Select::make('supply_type')
                    ->columnSpan(12)
                    ->label(self::getFieldName('supply_type'))
                    ->multiple()
                    ->options(SupplyType::forSelect())
                    ->reactive(),
                DeliveryBoxFieldset::get(
                    'Короба',
                    [
                        'fieldset_type' => SupplyType::BOX
                    ]
                )
                    ->visible(fn (callable $get) => in_array(SupplyType::BOX->value, $get('supply_type'))),
                DeliveryBoxFieldset::get(
                    'Короба на палете',
                    [
                        'fieldset_type' => SupplyType::BOX_ON_PALLET
                    ]
                )
                    ->visible(fn (callable $get) => in_array(SupplyType::BOX_ON_PALLET->value, $get('supply_type'))),
                PalletFieldset::get(
                    SupplyType::getName(SupplyType::PALLET1),
                    [
                        'fieldset_type' => SupplyType::PALLET1
                    ]
                )
                    ->visible(fn (callable $get) => in_array(SupplyType::PALLET1->value, $get('supply_type'))),
                PalletFieldset::get(
                    SupplyType::getName(SupplyType::PALLET2),
                    [
                        'fieldset_type' => SupplyType::PALLET2
                    ]
                )
                    ->visible(fn (callable $get) => in_array(SupplyType::PALLET2->value, $get('supply_type'))),
                PalletFieldset::get(
                    SupplyType::getName(SupplyType::PALLET3),
                    [
                        'fieldset_type' => SupplyType::PALLET3
                    ]
                )
                    ->visible(fn (callable $get) => in_array(SupplyType::PALLET3->value, $get('supply_type'))),
            ])
            ->visible(fn (callable $get) => $get('city_id') !== null)
            ->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
