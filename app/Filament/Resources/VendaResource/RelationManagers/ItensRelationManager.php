<?php

namespace App\Filament\Resources\VendaResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItensRelationManager extends RelationManager
{
    protected static string $relationship = 'itens';

    protected static ?string $title = 'Produtos';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('produto_id')
                    ->label('Produto')
                    ->required()
                    ->relationship(
                        'produto',
                        'nome'
                    )
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('qtd_itens')
                    ->integer()
                    ->required()
                    ->maxValue(999999),
                Forms\Components\TextInput::make('preco_venda')
                    ->label('Preço de Venda')
                    ->mask(RawJs::make('$money($input,  \',\')'))
                    ->prefix('R$')
                    ->required()
                    ->minValue(0)
                    ->maxValue(999999),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nome')
            ->columns([
                Tables\Columns\TextColumn::make('produto.nome'),
                Tables\Columns\TextColumn::make('qtd_itens')->numeric(),
                Tables\Columns\TextColumn::make('preco_venda')->numeric(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Adicionar'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
