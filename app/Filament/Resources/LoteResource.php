<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LoteResource\Pages;
use App\Filament\Resources\LoteResource\RelationManagers;
use App\Models\Lote;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LoteResource extends Resource
{
    protected static ?string $model = Lote::class;
    protected static ?string $slug = "lotes";

    protected static ?string $navigationGroup = "Cadastros";
    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationLabel = 'Lotes';
    protected static ?int $navigationSort = 3;

    protected static ?string $label = "lote";
    protected static ?string $pluralLabel = "lotes";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('leilao_id')
                    ->relationship('leilao', 'nome') // Relaciona ao modelo Leilao
                    ->default(fn() => request()->query('leilao')) // Obtém o ID do leilão da rota
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Leilão'),

                Forms\Components\TextInput::make('nome')
                    ->required()
                    ->label('Nome do Lote'),

                Forms\Components\Select::make('vendedor_id')
                    ->relationship('vendedor', 'nome')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('nome')->label('Nome do Lote'),
                Tables\Columns\TextColumn::make('leilao.nome')->label('Leilão'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('leilao')
                    ->relationship('leilao', 'nome')
                    ->label('Filtrar por Leilão'),
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
            RelationManagers\ArrematesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLotes::route('/'),
            'create' => Pages\CreateLote::route('/create'),
            'edit' => Pages\EditLote::route('/{record}/edit'),
        ];
    }
}
