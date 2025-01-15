<?php

namespace App\Filament\Resources\ClienteResource\Pages;

use App\Filament\Resources\ClienteResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditCliente extends EditRecord
{
    protected static string $resource = ClienteResource::class;

    protected function getSavedNotification(): ?Notification
    {
        #$user = \auth()->user();
        $user = Auth::user();
        return
            Notification::make()
            ->success()
            ->title('Editar ' . static::$resource::getModelLabel())
            ->body('O ' . static::$resource::getModelLabel() . ' foi alterado com sucesso!')
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
