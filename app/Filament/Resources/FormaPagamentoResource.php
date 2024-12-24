<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormaPagamentoResource\Pages;
use App\Filament\Resources\FormaPagamentoResource\RelationManagers;
use App\Models\FormaPagamento;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormaPagamentoResource extends Resource
{
    protected static ?string $model = FormaPagamento::class;

    protected static ?string $slug = "formas-pagamento";

    protected static ?string $navigationGroup = "Cadastros";
    protected static ?string $navigationIcon = 'heroicon-o-receipt-percent';
    protected static ?string $navigationLabel = 'Formas de Pagamento';
    protected static ?int $navigationSort = 5;

    protected static ?string $label = "forma de pagamento";
    protected static ?string $pluralLabel = "formas de pagamento";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->required()
                    ->label('Nome da Forma de Pagamento'),
                Forms\Components\TextInput::make('pct_desconto')
                    ->numeric()
                    ->required()
                    ->label('Desconto %'),
                Forms\Components\TextInput::make('forma_parcelamento')
                    ->required()
                    ->label('Forma de Parcelamento')
                    ->hint('Informar prazos em meses separados por / - Exemplo: 0/1/2/3/4')
                    ->columnSpanFull(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nome')->label('Forma de Pagamento')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pct_desconto')->label('Desconto %')
                    ->sortable()
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
            'index' => Pages\ListFormaPagamentos::route('/'),
            'create' => Pages\CreateFormaPagamento::route('/create'),
            'edit' => Pages\EditFormaPagamento::route('/{record}/edit'),
        ];
    }
}
