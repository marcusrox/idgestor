<?php

namespace App\Filament\Resources\LeilaoResource\Pages;

use App\Filament\Resources\LeilaoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLeilaos extends ListRecords
{
    protected static string $resource = LeilaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
