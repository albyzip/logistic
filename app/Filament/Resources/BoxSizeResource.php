<?php

namespace App\Filament\Resources;

use App\Models\BoxSize;
use App\Traits\Naming;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Filament\Resources\BoxSizeResource\Pages;
use Filament\Tables;

class BoxSizeResource extends Resource
{
    use Naming;
    protected static ?string $model = BoxSize::class;
    protected static ?string $name = 'BoxSize';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('length')
                    ->label('Длина')
                    ->columnSpan(4)
                    ->required(),
                TextInput::make('height')
                    ->label('Высота')
                    ->columnSpan(4)
                    ->required(),
                TextInput::make('width')
                    ->label('Ширина')
                    ->columnSpan(4)
                    ->required(),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('length')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('height')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('width')
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
            'index' => Pages\ListBoxSizes::route('/'),
            'create' => Pages\CreateBoxSize::route('/create'),
            'edit' => Pages\EditBoxSize::route('/{record}/edit'),
        ];
    }
}
