<?php

namespace App\Filament\Resources\VendedorResource\Pages;

use App\Filament\Resources\VendedorResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateVendedor extends CreateRecord
{
    protected static string $resource = VendedorResource::class;

    protected function getCreatedNotification(): ?Notification
    {

        return
            Notification::make()
            ->success()
            ->title('Novo vendedor')
            ->body('O novo vendedor foi cadastrado com sucesso!')
            ->sendToDatabase(\auth()->user());
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
