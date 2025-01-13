<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cidade extends BaseModel
{
    protected $table = 'cidades';

    public function uf(): BelongsTo
    {
        return $this->belongsTo(Uf::class);
    }
}
