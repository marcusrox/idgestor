<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NotificationResource\Pages;
use App\Filament\Resources\NotificationResource\RelationManagers;
use App\Models\Notification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NotificationResource extends Resource
{
    protected static ?string $model = Notification::class;

    protected static ?string $slug = "notificacoes";

    protected static ?string $navigationGroup = "Sistema";
    protected static ?string $navigationIcon = 'heroicon-o-bell';
    protected static ?string $navigationLabel = 'Notificações';
    protected static ?int $navigationSort = 101;

    protected static ?string $label = "notificação";
    protected static ?string $pluralLabel = "notificações";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\Textarea::make('data')
                //     ->label('Dados')
                //     ->disabled(),

                Forms\Components\Repeater::make('data')
                    ->label('Campo JSON')
                    ->schema([
                        Forms\Components\TextInput::make('key')->label('Chave'),
                        Forms\Components\TextInput::make('value')->label('Valor'),
                    ])->dehydrateStateUsing(function ($state) {
                        // Converte o array do Repeater para JSON no formato chave-valor
                        return collect($state)->mapWithKeys(fn($item) => [$item['key'] => $item['value']])->toArray();
                    })
                    ->afterStateHydrated(function ($component, $state) {
                        // Converte o JSON do modelo para o formato esperado pelo Repeater
                        $component->state(
                            collect($state ?? [])->map(fn(
                                $value,
                                $key
                            ) => ['key' => $key, 'value' => $value])->toArray()
                        );
                    })
                    ->columns(2) // Define quantas colunas mostrar
                    ->collapsible(), // Torna o campo expansível/colapsável
            ])->columns(1)->disabled();
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                //Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),

                Tables\Columns\TextColumn::make('data.title')->label('Título')->searchable(),
                Tables\Columns\TextColumn::make('data.body')->label('Corpo')->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Data de Envio')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\BooleanColumn::make('read_at')->label('Lida'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('read_at')
                    ->label('Lida')
                    ->nullable()
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->actions([
                Tables\Actions\Action::make('Marcar como Lida')
                    ->icon('heroicon-s-check')
                    ->action(fn($record) => $record->markAsRead())
                //->visible(fn($record) => is_null($record->read_at)),
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
            'index' => Pages\ListNotifications::route('/'),
            //'create' => Pages\CreateNotification::route('/create'),
            'edit' => Pages\EditNotification::route('/{record}/edit'),
        ];
    }
}
