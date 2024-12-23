<?php

namespace App\Filament\Resources\CompradorResource\Pages;

use App\Filament\Resources\CompradorResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateComprador extends CreateRecord
{
    protected static string $resource = CompradorResource::class;

    protected function getCreatedNotification(): ?Notification
    {
        #$user = \auth()->user();
        $user = Auth::user();
        return
            Notification::make()
            ->success()
            ->title('Novo comparador')
            ->body('O novo comprador foi cadastrado com sucesso!')
            ->sendToDatabase($user);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
