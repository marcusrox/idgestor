<?php

namespace App\Filament\Resources\VendaResource\Pages;

use App\Filament\Resources\VendaResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateVenda extends CreateRecord
{
    protected static string $resource = VendaResource::class;

    protected function getCreatedNotification(): ?Notification
    {
        $user = Auth::user();
        return
            Notification::make()
            ->success()
            ->title('Nova ' . static::$resource::getModelLabel())
            ->body('O nova ' . static::$resource::getModelLabel() . ' foi cadastrada com sucesso!')
            ->sendToDatabase($user);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function beforeCreate()
    {
        // Runs before the form fields are saved to the database.
        $formData = $this->data;
        //dd($formData);
    }
}
