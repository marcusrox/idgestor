<?php

namespace App\Filament\Resources;

use App\Enums\NaturezaOperacaoType;
use App\Enums\TipoFreteType;
use App\Filament\Resources\VendaResource\Pages;
use App\Filament\Resources\VendaResource\RelationManagers;
use App\Models\Cliente;
use App\Models\Config;
use App\Models\Venda;
use App\Rules\ClienteComRestricaoVenda;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class VendaResource extends Resource
{
    protected static ?string $model = Venda::class;

    protected static ?string $slug = "venda";

    protected static ?string $navigationGroup = "Cadastros";
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Vendas';
    protected static ?int $navigationSort = 5;

    protected static ?string $label = "venda";
    protected static ?string $pluralLabel = "vendas";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('vendedor_id')
                    ->label('Vendedor')
                    ->relationship(
                        'vendedor',
                        'nome',
                        modifyQueryUsing: function (Builder $query) {
                            /** @var \App\Models\User */
                            $user = Auth::user();
                            if ($user->is_vendedor()) {
                                $query->where('id', $user->vendedor->id);
                            }
                        },
                    )
                    ->searchable()
                    ->preload(),

                Forms\Components\Select::make('cliente_id')
                    ->label('Cliente')
                    ->relationship(
                        name: 'cliente',
                        modifyQueryUsing: function (Builder $query) {
                            /** @var \App\Models\User */
                            $user = Auth::user();
                            if ($user->is_vendedor()) {
                                $query->where('vendedor_id', $user->vendedor->id);
                            }
                        },
                    )
                    ->getOptionLabelFromRecordUsing(fn(Cliente $record) => "{$record->cpf_cnpj} - {$record->nome}")
                    ->searchable()
                    ->preload()
                    ->rules([
                        //new ClienteComRestricaoVenda('your_table_name', ['year_id', 'student_id']),
                    ]),

                Forms\Components\Section::make('Informações da Venda')
                    ->columns(3)
                    ->collapsed()
                    ->collapsible()
                    ->icon('heroicon-m-shopping-bag')
                    ->schema([
                        Forms\Components\Select::make('tipo_frete')
                            ->options(TipoFreteType::class)
                            ->label('Tipo de Frete')->required(),

                        Forms\Components\Select::make('natureza_operacao')
                            ->options(NaturezaOperacaoType::class)
                            ->label('Natureza da Operação')->required(),

                        Forms\Components\TextInput::make('numero_pedido')
                            ->label('Número do pedido (vendedor)'),

                        Forms\Components\TextInput::make('pct_comissao')
                            ->numeric()->maxValue(100)->label('Pct Comissão %')
                            ->default(Config::getValue('venda.pct_comissao_default'))->required(),

                        Forms\Components\TextInput::make('pct_vpc')
                            ->numeric()->maxValue(100)->label('Pct VPC %')
                            ->default(Config::getValue('venda.pct_vpc_default'))->required(),

                        Forms\Components\TextInput::make('prazos_pagamento')
                            ->label('Prazos de pagamento')->placeholder('Exemplo: 30/60/90/120')->required(),
                        Forms\Components\DatePicker::make('dt_base_faturamento')
                            ->default(now())->label('Data base para faturamento')->required(),
                        Forms\Components\Select::make('transportadora_id')
                            ->relationship('transportadora', 'nome')
                            ->searchable()
                            ->preload(),
                        Forms\Components\Textarea::make('observacao')
                            ->label('Observação'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->searchable()->sortable()->label('ID'),
                Tables\Columns\TextColumn::make('vendedor.nome')->searchable()->sortable()->label('Vendedor'),
                Tables\Columns\TextColumn::make('cliente.nome')->searchable()->sortable()->label('Cliente'),
                Tables\Columns\TextColumn::make('created_at')->label('Data Criação')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->label('Atualização')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                //->successNotificationTitle('Venda atualizada com sucesso'),
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
            RelationManagers\ItensRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVendas::route('/'),
            'create' => Pages\CreateVenda::route('/create'),
            'edit' => Pages\EditVenda::route('/{record}/edit'),
        ];
    }
}
