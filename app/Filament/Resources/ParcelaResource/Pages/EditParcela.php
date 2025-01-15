<?php

namespace App\Filament\Resources\ParcelaResource\Pages;

use App\Filament\Resources\ParcelaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditParcela extends EditRecord
{
    protected static string $resource = ParcelaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
