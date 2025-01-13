<?php

namespace App\Filament\Widgets;

use App\Models\Cliente;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class FaturamentoChart extends ChartWidget
{
    protected static ?string $heading = 'Faturamento';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = Trend::model(Cliente::class)
            ->between(
                start: now()->subYear(),
                end: now(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Faturamento',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
