<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompradorResource\Pages;
use App\Filament\Resources\CompradorResource\RelationManagers;
use App\Models\Comprador;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompradorResource extends Resource
{
    protected static ?string $model = Comprador::class;
    protected static ?string $slug = "compradores";

    protected static ?string $navigationGroup = "Cadastros";
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Compradores';

    protected static ?string $label = "comprador";
    protected static ?string $pluralLabel = "compradores";

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
                //
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
            'index' => Pages\ListCompradors::route('/'),
            'create' => Pages\CreateComprador::route('/create'),
            'edit' => Pages\EditComprador::route('/{record}/edit'),
        ];
    }
}
