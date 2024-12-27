<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use BaseModelTrait;
    protected $guarded = []; // Não precisa colocar os campos no fillable

    // Definir valor padrão para o campo guard_name
    protected $attributes = [
        'guard_name' => 'web',  // Definindo 'web' como valor padrão
    ];

    // Atributos que serao mostrados no form show
    // public $attrShow = [
    //     'id' => 'ID',
    //     'name' => 'Nome',
    //     'label' => 'Etiqueta',
    // ];

    // /**
    //  * A role may be given various permissions.
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    //  */
    // public function permissions()
    // {
    //     return $this->belongsToMany(Permission::class);
    // }

    // /**
    //  * Grant the given permission to a role.
    //  *
    //  * @param  Permission $permission
    //  *
    //  * @return mixed
    //  */
    // public function givePermissionTo(Permission $permission)
    // {
    //     return $this->permissions()->save($permission);
    // }

    /**
     * Change activity log event description
     *
     * @param string $eventName
     *
     * @return string
     */
    // public function getDescriptionForEvent($eventName)
    // {
    //     //return __CLASS__ . " | " . $eventName;
    // }
}
