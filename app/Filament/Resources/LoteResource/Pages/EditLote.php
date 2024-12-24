<?php

namespace App\Filament\Resources\LoteResource\Pages;

use App\Filament\Resources\LoteResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditLote extends EditRecord
{
    protected static string $resource = LoteResource::class;

    protected function getSavedNotification(): ?Notification
    {
        #$user = \auth()->user();
        $user = Auth::user();
        return
            Notification::make()
            ->success()
            ->title('Editar lote')
            ->body('O lote foi alterado com sucesso!')
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
