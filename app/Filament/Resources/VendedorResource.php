<?php

namespace App\Filament\Resources;

use App\Enums\PessoaType;
use App\Enums\UfType;
use App\Filament\Resources\VendedorResource\Pages;
use App\Filament\Resources\VendedorResource\RelationManagers;
use App\Models\Vendedor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class VendedorResource extends Resource
{
    protected static ?string $model = Vendedor::class;
    protected static ?string $slug = "vendedores";

    protected static ?string $navigationGroup = "Cadastros";
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationLabel = 'Vendedores';
    protected static ?int $navigationSort = 2;

    protected static ?string $label = "vendedor";
    protected static ?string $pluralLabel = "vendedores";

    public static function form(Form $form): Form
    {
        /** @var \App\Models\User */
        //$user = auth()->user();

        return $form
            ->schema([
                Forms\Components\Section::make('Informações do Vendedir')
                    ->compact()
                    ->columns(2)
                    //->description('Dados cadastrais do comprador')
                    ->collapsible()
                    ->icon('heroicon-m-shopping-bag')
                    ->schema([
                        Forms\Components\TextInput::make('nome')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('razao_social')
                            ->label('Razão Social')
                            ->maxLength(255),
                        Forms\Components\Select::make('tipo_pessoa')
                            ->required()
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
                            ->maxLength(20),
                        Forms\Components\TextInput::make('celular')
                            ->mask('(99) 99999-9999')
                            ->required()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('endereco')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('numero')
                            ->required()
                            ->maxLength(10),
                        Forms\Components\TextInput::make('complemento')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('bairro')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('cidade')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('uf')
                            ->native(false)
                            ->options(UfType::class),

                    ]),
                Forms\Components\Select::make('user_id')
                    //->visible(!$user->is_vendedor())
                    ->label('Usuário do sistema')
                    // ->relationship('user', 'name')
                    ->options(
                        \App\Models\User::all()->mapWithKeys(function ($user) {
                            return [$user->id => "{$user->name} ({$user->email})"];
                        })
                    )
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
                Tables\Columns\TextColumn::make('celular')->searchable()->sortable(),
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
                    ->visible(Auth::user()->isAdmin()),
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
            'index' => Pages\ListVendedors::route('/'),
            'create' => Pages\CreateVendedor::route('/create'),
            'edit' => Pages\EditVendedor::route('/{record}/edit'),
        ];
    }
}
