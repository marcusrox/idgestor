<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transportadora extends BaseModel
{

    public function uf(): BelongsTo
    {
        return $this->belongsTo(Uf::class, 'end_uf_id');
    }

    public function cidade(): BelongsTo
    {
        return $this->belongsTo(Cidade::class, 'end_cidade_id');
    }
}
