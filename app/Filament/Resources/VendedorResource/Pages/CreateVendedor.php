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
        $recipient = \auth()->user();
        //dd($recipient);
        return
            Notification::make()
            ->success()
            ->seconds(30)
            ->title('Novo vendedor')
            ->body('O novo vendedor foi cadastrado com sucesso!')
            ->sendToDatabase($recipient);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
