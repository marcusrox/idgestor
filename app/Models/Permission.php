<?php

namespace App\Models;

class Permission extends BaseModel
{

    protected $guarded = []; // Não precisa colocar os campos no fillable

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
