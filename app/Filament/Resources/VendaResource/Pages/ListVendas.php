<?php

namespace App\Filament\Resources\VendaResource\Pages;

use App\Filament\Resources\VendaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Str;

class ListVendas extends ListRecords
{
    protected static string $resource = VendaResource::class;

    //protected static ?string $title = "Teste";

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Registrar nova venda'),
        ];
    }
}
