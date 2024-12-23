<?php

namespace App\Filament\Resources\LeilaoResource\Pages;

use App\Filament\Resources\LeilaoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLeilao extends EditRecord
{
    protected static string $resource = LeilaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
