<?php

namespace App\Filament\Resources;

use App\Enums\PessoaType;
use App\Filament\Resources\CompradorResource\Pages;
use App\Filament\Resources\CompradorResource\RelationManagers;
use App\Models\Comprador;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
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
    protected static ?int $navigationSort = 1;

    protected static ?string $label = "comprador";
    protected static ?string $pluralLabel = "compradores";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informações do Vendedor')
                    ->columns(2)
                    ->description('Dados cadastrais do vendedor')
                    ->collapsible()
                    ->icon('heroicon-m-shopping-bag')
                    ->schema([
                        Forms\Components\TextInput::make('nome')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('razao_social')
                            ->label('Razão Social')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('tipo_pessoa')
                            ->native(false)
                            ->options(PessoaType::class),
                        Forms\Components\TextInput::make('cpf_cnpj')
                            ->label('CPF/CNPJ')
                            ->mask(RawJs::make(<<<'JS'
                                    ($input.length <= 14) ? '999.999.999-99' : '99.999.999/9999-99'
                                JS))
                            ->required()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('telefone')
                            ->mask('(99) 99999-9999')
                            ->required()
                            ->maxLength(20),


                    ]),
                Forms\Components\Select::make('user_id')
                    //->visible(!$user->is_vendedor())
                    ->label('Usuário')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->searchable()->sortable()->label('ID'),
                Tables\Columns\TextColumn::make('nome')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('cpf_cnpj')->searchable()->sortable()->label('CPF/CNPJ'),
                Tables\Columns\TextColumn::make('telefone')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
