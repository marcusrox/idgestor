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
use Adrianovcar\Asaas\Asaas;
use Adrianovcar\Asaas\Adapter\GuzzleHttpAdapter;
use Adrianovcar\Asaas\Entity\Payment as PaymentEntity;

class ParcelaResource extends Resource
{
    protected static ?string $model = Parcela::class;

    protected static ?string $slug = "parcelas";

    protected static ?string $navigationGroup = "Cadastros";
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Parcelas';
    protected static ?int $navigationSort = 5;

    protected static ?string $label = "parcela";
    protected static ?string $pluralLabel = "parcelas";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Placeholder::make('leilao_nome')
                    ->label('Leilão')
                    ->content(fn($record) => $record->arremate->lote->leilao->nome ?? 'Desconhecido'),
                Forms\Components\Placeholder::make('lote_nome')
                    ->label('Lote')
                    ->content(fn($record) => $record->arremate->lote->nome ?? 'Desconhecido'),
                Forms\Components\Placeholder::make('comprador_nome')
                    ->label('Comprador')
                    ->content(fn($record) => $record->arremate->comprador->nome ?? 'Desconhecido'),
                Forms\Components\TextInput::make('nu_parcela')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('dt_vencimento')->format('DD/MM/YYYY')
                    ->required(),
                Forms\Components\TextInput::make('vl_parcela')
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
                Forms\Components\TextInput::make('asaas_invoice_url')
                    ->label('Link de Pagamento')
                    ->disabled()
                    ->url()
                    ->suffixIcon('heroicon-o-link'),

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('arremate.comprador.nome')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('nu_parcela')
                    ->label('#')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('dt_vencimento')
                    ->label('Vencimento')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('vl_parcela')
                    ->label('Valor')
                    ->money('BRL')
                    ->sortable(),
                Tables\Columns\TextColumn::make('vl_pago')
                    ->label('Pago')
                    ->money('BRL')
                    ->sortable(),
                Tables\Columns\TextColumn::make('st_parcela')
                    ->label('Status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dt_liquidacao')
                    ->label('Liquidação')
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
                                Forms\Components\Group::make([
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
                                ])->columns(2),
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
            ->filtersLayout(Tables\Enums\FiltersLayout::AboveContent)
            ->filtersFormColumns(1)
            ->actions([
                Tables\Actions\EditAction::make(),

                Tables\Actions\Action::make('generateAsaasLink')
                    ->label('Link de Pagamento')
                    ->action(function ($record, $data) {
                        $adapter = new GuzzleHttpAdapter(env('ASAAS_API_KEY'));
                        $asaas = new Asaas($adapter, 'sandbox');

                        if (empty($record->arremate->comprador->asaas_customer_id)) {
                            // Criar o cliente
                            $customer = $asaas->customer()->create([
                                'name' => $record->arremate->comprador->nome,
                                'email' => $record->arremate->comprador->user->email,
                                'phone' => $record->arremate->comprador->telefone,
                                'mobilePhone' => $record->arremate->comprador->celular,
                                'cpfCnpj' => $record->arremate->comprador->cpf_cnpj,
                                'postalCode' => $record->arremate->comprador->cep,
                                'address' => $record->arremate->comprador->endereco,
                                'addressNumber' => $record->arremate->comprador->numero,
                                'complement' => $record->arremate->comprador->complemento,
                                'province' => $record->arremate->comprador->bairro,
                                'city' => $record->arremate->comprador->cidade,
                                'state' => $record->arremate->comprador->uf,
                            ]);
                            $record->arremate->comprador->update(['asaas_customer_id' => $customer->id]);
                        }

                        // Criar o pagamento
                        $new_payment = new PaymentEntity();
                        $new_payment->customer = $record->arremate->comprador->asaas_customer_id;
                        $new_payment->billingType = 'BOLETO';
                        $new_payment->dueDate = $record->dt_vencimento->format('Y-m-d');
                        $new_payment->value = $record->vl_parcela;
                        $new_payment->description = 'Parcela ' . $record->nu_parcela . ' do lote ' . $record->arremate->lote->nome . ' do leilão ' . $record->arremate->lote->leilao->nome;
                        $new_payment->externalReference = $record->id;

                        $payment = $asaas->payment()->create($new_payment);

                        // $array_payment = $payment->toArray();
                        $record->update(['asaas_invoice_url' => $payment->invoiceUrl]);

                        // Retorna os dados do boleto para serem exibidos no modal
                        $data['invoiceUrl'] = $payment->invoiceUrl;
                        $data['dueDate'] = $record->dt_vencimento->format('d/m/Y');
                        $data['value'] = $record->vl_parcela;
                        return $data;
                    })
                    // ->modalHeading('Inegração com pagamento Asaas')
                    // ->modalSubheading('Confira as informações da cobrança gerada.')
                    // ->modalButton('Fechar')
                    // ->form([
                    //     Forms\Components\TextInput::make('asaas_invoice_url')
                    //         ->label('Link de Pagamento')
                    //         ->disabled(),
                    //     // Forms\Components\TextInput::make('dueDate')
                    //     //     ->label('Data de Vencimento')
                    //     //     ->disabled(),
                    //     // Forms\Components\TextInput::make('value')
                    //     //     ->label('Valor')
                    //     //     ->prefix('R$')
                    //     //     ->disabled(),
                    // ])
                    ->icon('heroicon-o-link'),
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
