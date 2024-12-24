<?php

namespace App\Filament\Resources\LeilaoResource\Pages;

use App\Filament\Resources\LeilaoResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditLeilao extends EditRecord
{
    protected static string $resource = LeilaoResource::class;

    protected function getSavedNotification(): ?Notification
    {
        #$user = \auth()->user();
        $user = Auth::user();
        return
            Notification::make()
            ->success()
            ->title('Editar leilão')
            ->body('O leilão foi alterado com sucesso!')
            ->sendToDatabase($user);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
