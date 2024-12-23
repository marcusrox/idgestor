<?php

namespace App\Filament\Resources\LoteResource\Pages;

use App\Filament\Resources\LoteResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateLote extends CreateRecord
{
    protected static string $resource = LoteResource::class;

    protected function getCreatedNotification(): ?Notification
    {

        return
            Notification::make()
            ->success()
            ->title('Novo lote')
            ->body('O novo lote foi cadastrado com sucesso!')
            ->sendToDatabase(\auth()->user());
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
