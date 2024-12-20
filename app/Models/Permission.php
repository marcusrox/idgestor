<?php

namespace App\Models;

class Permission extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'label'];

    // Atributos que serao mostrados no form show
    public $attrShow = [
        'id' => 'ID',
        'name' => 'Nome',
        'label' => 'Etiqueta',
    ];

    /**
     * A permission can be applied to roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

}
