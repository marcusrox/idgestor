<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\Activitylog\Models\Activity;

class LogLoginActivity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event)
    {
        $user = $event->user;
        $ip = request()->ip();  // Obtém o IP do usuário
        $device = request()->header('User-Agent');  // Obtém o User-Agent do usuário

        activity()
            ->causedBy($user)
            ->withProperties([
                'ip' => $ip,
                'device' => $device,
            ])
            ->event('login')
            ->log('Usuário acessou o sistema'); // A descrição da atividade
    }
}
