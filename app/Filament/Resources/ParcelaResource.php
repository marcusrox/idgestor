<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParcelaResource\Pages;
use App\Filament\Resources\ParcelaResource\RelationManagers;
use App\Models\Leilao;
use App\Models\Lote;
use App\Models\Parcela;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ParcelaResource extends Resource
{
    protected static ?string $model = Parcela::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tables\Columns\TextColumn::make('arremate.comprador.nome')->label('Comprador'),
                Forms\Components\TextInput::make('nu_parcela')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('dt_vencimento')->format('DD/MM/YYYY')
                    ->required(),
                Forms\Components\TextInput::make('vl_parcela')->currency('BRL')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('vl_desconto')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('vl_pago')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('st_parcela')
                    ->required()
                    ->maxLength(2),
                Forms\Components\DatePicker::make('dt_liquidacao'),
                Forms\Components\TextInput::make('created_by')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('updated_by')
                    ->numeric()
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('arremate_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nu_parcela')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('dt_vencimento')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('vl_parcela')
                    ->money('BRL')
                    ->sortable(),
                Tables\Columns\TextColumn::make('vl_desconto')
                    ->money('BRL')
                    ->sortable(),
                Tables\Columns\TextColumn::make('vl_pago')
                    ->money('BRL')
                    ->sortable(),
                Tables\Columns\TextColumn::make('st_parcela')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dt_liquidacao')
                    ->date('d/m/Y')
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
                Tables\Filters\Filter::make('leilao-lote-filter')
                    ->form(
                        function () {
                            return [
                                Forms\Components\Select::make('leilao_id')
                                    ->label('Leilão')
                                    ->placeholder('Selecione um leilão')
                                    ->options(Leilao::pluck('nome', 'id'))
                                    ->reactive()
                                    ->afterStateUpdated(fn($set) => $set('lote_id', null)),
                                Forms\Components\Select::make('lote_id')
                                    ->placeholder('Selecione um lote')
                                    ->label('Lote')
                                    ->options(function (callable $get) {
                                        $leilaoId = $get('leilao_id');
                                        if ($leilaoId) {
                                            return Lote::where('leilao_id', $leilaoId)->pluck('nome', 'id');
                                        }
                                        return [];
                                    }),

                            ];
                        }
                    )
                    ->query(
                        function (Builder $query, array $data): Builder {

                            // return $query
                            //     ->whereHas('arremate.lote.leilao', function ($q) use ($data) {
                            //         $q->where('id', $data['leilao_id']);
                            //     })
                            //     ->whereHas('arremate.lote', function ($q) use ($data) {
                            //         $q->where('id', $data['lote_id']);
                            //     });
                            if (!empty($data['leilao_id'])) {
                                $query
                                    ->whereHas('arremate.lote.leilao', function ($q) use ($data) {
                                        $q->where('id', $data['leilao_id']);
                                    });
                            }
                            if (!empty($data['lote_id'])) {
                                $query
                                    ->whereHas('arremate.lote', function ($q) use ($data) {
                                        $q->where('id', $data['lote_id']);
                                    });
                            }
                            return $query;
                        }
                    ),
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
            'index' => Pages\ListParcelas::route('/'),
            'create' => Pages\CreateParcela::route('/create'),
            'edit' => Pages\EditParcela::route('/{record}/edit'),
        ];
    }
}
