<?php

namespace App\Filament\Resources\VendedorResource\Pages;

use App\Filament\Resources\VendedorResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditVendedor extends EditRecord
{
    protected static string $resource = VendedorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getSavedNotification(): ?Notification
    {
        $recipient = \auth()->user();
        //dd($recipient);
        return
            Notification::make()
            ->success()
            ->seconds(30)
            ->title('Editar vendedor')
            ->body('O vendedor foi alterado com sucesso!')
            ->sendToDatabase($recipient);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
