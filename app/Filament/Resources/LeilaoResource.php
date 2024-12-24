<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeilaoResource\Pages;
use App\Filament\Resources\LeilaoResource\RelationManagers;
use App\Models\Leilao;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class LeilaoResource extends Resource
{
    protected static ?string $model = Leilao::class;
    protected static ?string $slug = "leiloes";

    protected static ?string $navigationGroup = "Cadastros";
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationLabel = 'Leilões';
    protected static ?int $navigationSort = 3;

    protected static ?string $label = "leilão";
    protected static ?string $pluralLabel = "leilões";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nome_organizador')
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('html_descricao')
                    ->label('Descrição')
                    ->columnSpanFull()
                    ->placeholder('Escreva aqui...')
                    //->required()
                    ->disableToolbarButtons(['codeBlock', 'blockquote']) // Remove botões específicos
                    ->maxLength(5000) // Limite de caracteres
                    ->hint('Use o editor para formatar seu texto.') // Dica exibida abaixo do campo
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'link',
                        'heading',
                        'orderedList',
                        'bulletList',
                        'redo',
                        'undo',
                    ]),

                Forms\Components\Datepicker::make('dt_leilao_de')
                    ->required(),
                Forms\Components\Datepicker::make('dt_leilao_ate')
                    ->required(),
                Forms\Components\TextInput::make('local_leilao')
                    ->label('Local do Leilão')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        /** @var User $user */
        $user = Auth::user();
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->searchable()->sortable()->label('ID'),
                Tables\Columns\TextColumn::make('nome')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('nome_organizador')->searchable()->sortable()->label('Organizador'),
                //Tables\Columns\TextColumn::make('lotes')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('lotes_count')->counts('lotes')->sortable(),
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
                Tables\Actions\Action::make('Criar Lote')
                    ->url(fn($record) => route('filament.admin.resources.lotes.create', ['leilao' => $record->id]))
                    ->icon('heroicon-o-plus')
                    ->button()
                    ->tooltip('Clique para adicionar um lote para esse leilão')
                    ->label('Lote'),
                \Rmsramos\Activitylog\Actions\ActivityLogTimelineTableAction::make('Log')
                    ->color('danger')
                    ->visible($user->isAdmin()),
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
            'index' => Pages\ListLeilaos::route('/'),
            'create' => Pages\CreateLeilao::route('/create'),
            'edit' => Pages\EditLeilao::route('/{record}/edit'),
        ];
    }
}
