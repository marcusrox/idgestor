<?php

namespace App\Filament\Resources\CompradorResource\Pages;

use App\Filament\Resources\CompradorResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditComprador extends EditRecord
{
    protected static string $resource = CompradorResource::class;

    protected function getSavedNotification(): ?Notification
    {
        #$user = \auth()->user();
        $user = Auth::user();
        return
            Notification::make()
            ->success()
            ->title('Editar comprador')
            ->body('O comprador foi alterado com sucesso!')
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
