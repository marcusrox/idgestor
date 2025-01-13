<?php

namespace App\Filament\Widgets;

use App\Models\Cliente;
use App\Models\Patient;
use App\Models\Venda;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SumarioOverview extends BaseWidget
{
    protected static ?int $sort = 0;
    protected function getStats(): array
    {
        return [
            Stat::make('Clientes', Cliente::query()->count()),
            Stat::make('Vendas', Cliente::query()->count()),
            Stat::make('Faturamento', Cliente::query()->count()),
            //Stat::make('Faturamento', Patient::query()->where('type', 'rabbit')->count()),
            //Stat::make('Vendas', Venda::query()->count()),
        ];
    }
}
