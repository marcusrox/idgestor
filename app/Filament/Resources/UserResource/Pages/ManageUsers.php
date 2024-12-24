<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;

use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ManageUsers extends ManageRecords
{
    protected static string $resource = UserResource::class;

    public function getTabs(): array
    {
        return [
            'todos' => Tab::make()->icon('heroicon-m-user-group'),
            'Ativos' => Tab::make()
                ->badge(User::query()->where('active', true)->count())
                ->modifyQueryUsing(fn(Builder $query) => $query->where('active', true)),
            'Inativos' => Tab::make()
                ->badge(User::query()->where('active', false)->count())
                ->modifyQueryUsing(fn(Builder $query) => $query->where('active', false)),
        ];
    }
    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     dd($data);
    //     return $data;
    // }
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data): array {
                    $data['email_verified_at'] = Carbon::now();
                    //$data['user_id'] = auth()->id();
                    //dd($data);
                    return $data;
                })
                ->after(
                    fn() => Notification::make()
                        ->title('Novo usuário cadastrado no sistema')
                        ->sendToDatabase(\auth()->user())
                )

        ];
    }
}
