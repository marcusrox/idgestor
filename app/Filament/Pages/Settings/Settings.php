<?php

namespace App\Filament\Pages\Settings;

use Closure;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Outerweb\FilamentSettings\Filament\Pages\Settings as BaseSettings;

class Settings extends BaseSettings
{
    protected static ?string $navigationGroup = "Sistema";
    protected static ?int $navigationSort = 100;

    public static function getNavigationLabel(): string
    {
        return 'Configurações';
    }

    public function getTitle(): string
    {
        return 'Configurações';
    }

    public function schema(): array|Closure
    {
        return [
            Tabs::make('Settings')
                ->schema([
                    Tabs\Tab::make('Vendas')
                        ->schema([
                            TextInput::make('venda.pct_comissao_default')
                                ->suffix('%')
                                ->numeric()
                                ->required(),
                            TextInput::make('venda.pct_vpc_default')
                                ->suffix('%')
                                ->numeric()
                                ->required(),
                        ]),
                    Tabs\Tab::make('Seo')
                        ->schema([
                            TextInput::make('seo.title'),

                            TextInput::make('seo.description'),
                        ]),
                ]),
        ];
    }
}
