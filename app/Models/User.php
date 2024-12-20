<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    //use LogsActivity;
    use HasRoles;
    //use UserstampTrait;
    use BaseModelTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function accesses()
    {
        // Não esqueça de usar a classe Access: use App\Models\Access;
        return $this->hasMany(AccessLog::class);
    }

    // public function registerAccess(Request $request)
    // {
    //     // Cadastra na tabela accesses um novo registro com as informações do usuário logado + data e hora
    //     return $this->accesses()->create([
    //         'user_id'   => $this->id,
    //         'logon_at'  => date('YmdHis'),
    //         'ip_addr' => $request->server('REMOTE_ADDR'),
    //         'user_agent' => $request->server('HTTP_USER_AGENT'),
    //     ]);
    // }

    public function isComprador()
    {
        return $this->hasRole('Comprador');
    }

    public function isVendedor()
    {
        return $this->hasRole('Vendedor');
    }

    public function isAdmin()
    {
        return $this->hasRole('Administrador');
    }
}
