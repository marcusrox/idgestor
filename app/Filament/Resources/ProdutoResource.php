<?php

namespace App\Filament\Resources;

use App\Enums\PessoaType;
use App\Filament\Resources\ProdutoResource\Pages;
use App\Filament\Resources\ProdutoResource\RelationManagers;
use App\Models\Produto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProdutoResource extends Resource
{
    protected static ?string $model = Produto::class;
    protected static ?string $slug = "produto";

    protected static ?string $navigationGroup = "Cadastros";
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Produtos';
    protected static ?int $navigationSort = 5;

    protected static ?string $label = "produto";
    protected static ?string $pluralLabel = "produtos";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informações do Produto')
                    ->compact()
                    ->columns(2)
                    //->description('Dados cadastrais do cliente')
                    ->collapsible()
                    ->icon('heroicon-m-shopping-bag')
                    ->schema([
                        Forms\Components\TextInput::make('nome')
                            ->required()
                            ->maxLength(255)
                            ->label('Nome do Produto'),
                        Forms\Components\TextInput::make('codigo')
                            ->required()
                            ->maxLength(255)
                            ->label('Código'),
                        Forms\Components\Textarea::make('descricao')
                            ->maxLength(255)
                            ->label('Descrição')
                            ->columnSpan(2),
                        Forms\Components\Select::make('categoria_id')
                            ->relationship('categoria', 'nome')
                            ->required()
                            ->label('Categoria'),
                        Forms\Components\Select::make('fornecedor_id')
                            ->relationship('fornecedor', 'nome')
                            ->required()
                            ->label('Fornecedor'),
                        Forms\Components\Grid::make(3)->schema([
                            Forms\Components\TextInput::make('ncm')
                                ->label('NCM'),
                            Forms\Components\TextInput::make('cfop')
                                ->hintIcon('heroicon-m-question-mark-circle', tooltip: 'Código Fiscal de Operações e Prestações')
                                ->label('CFOP'),
                            Forms\Components\TextInput::make('cst')
                                ->hintIcon('heroicon-m-question-mark-circle', tooltip: 'Código de Situação Tributária')
                                ->label('CST'),
                        ]),
                        Forms\Components\Grid::make(3)->schema([
                            Forms\Components\TextInput::make('unidade')
                                ->placeholder('ex.: UN, KG, PCT, CX, etc.')
                                ->label('Unidade'),
                            Forms\Components\TextInput::make('peso_bruto')
                                ->suffix('gr')
                                ->numeric()
                                ->label('Peso Bruto'),
                            Forms\Components\TextInput::make('peso_liquido')
                                ->suffix('gr')
                                ->numeric()
                                ->label('Peso Líquido'),
                        ]),
                        Forms\Components\Grid::make(3)->schema([
                            Forms\Components\TextInput::make('largura')
                                ->suffix('cm')
                                ->numeric()
                                ->label('Largura'),
                            Forms\Components\TextInput::make('altura')
                                ->suffix('cm')
                                ->numeric()
                                ->label('Altura (cm)'),
                            Forms\Components\TextInput::make('profundidade')
                                ->suffix('cm')
                                ->numeric()
                                ->label('Profundidade (cm)'),
                        ]),
                        Forms\Components\Grid::make(3)->schema([
                            Forms\Components\TextInput::make('estoque_minimo')
                                ->numeric()
                                ->label('Estoque Mínimo'),
                            Forms\Components\TextInput::make('estoque_atual')
                                ->numeric()
                                ->label('Estoque Atual'),
                            Forms\Components\TextInput::make('estoque_maximo')
                                ->numeric()
                                ->label('Estoque Máximo'),
                        ]),
                        Forms\Components\Grid::make(3)->schema([
                            Forms\Components\TextInput::make('preco_custo')
                                ->prefix('R$')
                                ->numeric()
                                ->label('Preço de Custo'),
                            Forms\Components\TextInput::make('preco_venda')
                                ->prefix('R$')
                                ->required()
                                ->numeric()
                                ->label('Preço de Venda'),
                            Forms\Components\TextInput::make('pct_mc')
                                ->suffix('%')
                                ->numeric()
                                ->hintIcon('heroicon-m-question-mark-circle', tooltip: 'Margem de Contribuição')
                                ->label('Margem de Contribuição'),
                        ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('codigo')->sortable()->searchable()->label('Código'),
                Tables\Columns\TextColumn::make('nome')->sortable()->searchable()->label('Nome'),
                Tables\Columns\TextColumn::make('categoria.nome')->sortable()->searchable()->label('Categoria'),
                Tables\Columns\TextColumn::make('preco_venda')->money('BRL')->label('Preço de Venda'),
                Tables\Columns\TextColumn::make('estoque_atual')->label('Estoque Atual'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i:s')
                    ->label('Criado em')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d/m/Y H:i:s')
                    ->label('Atualizado em')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                \Rmsramos\Activitylog\Actions\ActivityLogTimelineTableAction::make('Log')
                    ->color('danger')
                    ->visible(auth()->user()->isAdmin()),
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
            'index' => Pages\ListProdutos::route('/'),
            'create' => Pages\CreateProduto::route('/create'),
            'edit' => Pages\EditProduto::route('/{record}/edit'),
        ];
    }
}
