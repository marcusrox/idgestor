<?php

namespace App\Filament\Resources\LoteResource\RelationManagers;

use App\Models\Arremate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Closure;
use Filament\Forms\Get;
use Illuminate\Database\Eloquent\Model;

class ArrematesRelationManager extends RelationManager
{
    protected static string $relationship = 'arremates';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('lote_id')
                //     //->disabled()
                //     //->visible(false)
                //     ->label('Lote'),
                Forms\Components\Select::make('comprador_id')
                    ->relationship('comprador', 'nome')
                    ->searchable()
                    ->preload(),
                //->rules(Arremate::rules()),
                // ->rules([
                //     fn(Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
                //         $loteId = $get('lote_id'); // Pega o ID do lote enviado no formulário
                //         //$loteId = request()->input('lote_id'); // Obtém o valor do request
                //         //dd($record);
                //         $existe = Arremate::where('lote_id', $loteId)
                //             ->where('comprador_id', $value)
                //             ->exists();

                //         if ($existe) {
                //             $fail('Este comprador já arrematou este lote.');
                //         }
                //     },
                // ]),

                Forms\Components\TextInput::make('vl_parcela')
                    ->prefix('R$') // Adiciona o prefixo "R$"
                    ->numeric() // Aceita apenas números
                    ->label('Valor da Parcela')
                    ->extraAttributes(['data-mask' => 'money']) // Adiciona o atributo data-mask com o valor "money"
                    ->required(),

                Forms\Components\Datepicker::make('dt_primeiro_pagamento')
                    ->label('Data do Prim. Pgto')
                    ->required(),
                Forms\Components\Select::make('forma_pagamento_id')
                    ->relationship('forma_pagamento', 'nome')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('comprador.nome')
            ->columns([
                Tables\Columns\TextColumn::make('comprador.nome')->label('Comprador'),
                Tables\Columns\TextColumn::make('forma_pagamento.nome')->label('Forma de Pagamento'),
                Tables\Columns\TextColumn::make('vl_parcela')->label('Valor da Parcela')->money('BRL'),
                Tables\Columns\TextColumn::make('parcelas_count')
                    ->label('Parcelas')
                    ->counts('parcelas') // Agrega o relacionamento
                    ->sortable(), // Permite ordenar por quantidade
                //Tables\Columns\TextColumn::make('dt_primeiro_pagamento')->label('Data do Prim. Pgto'),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Adicionar Arremate'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('gerar_parcelas')
                    ->label('Gerar Parcelas')
                    ->icon('heroicon-o-chart-bar')
                    ->action(function ($record) {
                        // Lógica para gerar as parcelas
                        $record->gerarParcelas();
                        //dd($record->toArray());
                    })
                    ->requiresConfirmation()
                    ->color('success'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
