<?php

namespace App\Filament\Resources;

use App\Models\PaletWeight;
use App\Models\Permission;
use App\Traits\Naming;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use App\Filament\Resources\PaletWeightResource\Pages;

class PaletWeightResource extends Resource
{
    use Naming;
    protected static ?string $model = PaletWeight::class;
    protected static ?string $name = 'PaletWeight';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('weight')
                    ->unique(ignoreRecord: true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('weight')
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
            'index' => Pages\ListPaletWeight::route('/'),
            'create' => Pages\CreatePaletWeight::route('/create'),
            'edit' => Pages\EditPaletWeight::route('/{record}/edit'),
        ];
    }
}
