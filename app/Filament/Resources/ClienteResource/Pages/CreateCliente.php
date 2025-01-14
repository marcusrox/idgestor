<?php

namespace App\Filament\Resources\ClienteResource\Pages;

use App\Filament\Resources\ClienteResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateCliente extends CreateRecord
{
    protected static string $resource = ClienteResource::class;

    protected function getCreatedNotification(): ?Notification
    {
        $user = Auth::user();
        return
            Notification::make()
            ->success()
            ->title('Novo ' . static::$resource::getModelLabel())
            ->body('O novo ' . static::$resource::getModelLabel() . ' foi cadastrado com sucesso!')
            ->sendToDatabase($user);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
