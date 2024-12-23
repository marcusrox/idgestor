<?php

namespace App\Filament\Resources\LeilaoResource\Pages;

use App\Filament\Resources\LeilaoResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateLeilao extends CreateRecord
{
    protected static string $resource = LeilaoResource::class;

    protected function getCreatedNotification(): ?Notification
    {

        return
            Notification::make()
            ->success()
            ->title('Novo leilão')
            ->body('O novo leilão foi cadastrado com sucesso!')
            ->sendToDatabase(\auth()->user());
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
