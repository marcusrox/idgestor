<?php

namespace App\Filament\Resources\ParcelaResource\Pages;

use App\Filament\Resources\ParcelaResource;
use App\Models\Leilao;
use App\Models\Lote;
use Filament\Actions;

use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Button;
use Filament\Tables\Actions\ButtonAction;

class ListParcelas extends ListRecords
{
    protected static string $resource = ParcelaResource::class;
    public ?int $leilaoId = null;
    public ?int $loteId = null;

    protected function getHeaderWidgets(): array
    {
        return [
            \Filament\Forms\Components\Form::make()
                ->schema([
                    Select::make('leilao_id')
                        ->label('Leilão')
                        ->options(Leilao::pluck('nome', 'id'))
                        ->reactive()
                        ->afterStateUpdated(fn($set) => $set('lote_id', null)),
                    Select::make('lote_id')
                        ->label('Lote')
                        ->options(function (callable $get) {
                            $leilaoId = $get('leilao_id');
                            if ($leilaoId) {
                                return Lote::where('leilao_id', $leilaoId)->pluck('numero', 'id');
                            }
                            return [];
                        }),
                    ButtonAction::make('filtrar')
                        ->label('Aplicar Filtros')
                        ->action(function (array $data) {
                            $this->leilaoId = $data['leilao_id'] ?? null;
                            $this->loteId = $data['lote_id'] ?? null;
                        }),
                ])
                ->columns(3)
        ];
    }

    protected function getTableQuery(): Builder
    {
        $query = parent::getTableQuery();

        if ($this->leilaoId) {
            $query->whereHas('arremate.lote.leilao', function ($q) {
                $q->where('id', $this->leilaoId);
            });
        }

        if ($this->loteId) {
            $query->whereHas('arremate.lote', function ($q) {
                $q->where('id', $this->loteId);
            });
        }

        return $query;
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
