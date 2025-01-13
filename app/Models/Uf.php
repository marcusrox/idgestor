<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Uf extends BaseModel
{

    public function cidades(): HasMany
    {
        return $this->hasMany(Cidade::class);
    }
}
