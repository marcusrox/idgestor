<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fornecedor extends BaseModel
{
    protected $table = 'fornecedores';
    protected $guarded = []; // Não precisa colocar os campos no fillable

    public function uf(): BelongsTo
    {
        return $this->belongsTo(Uf::class, 'uf_id');
    }

    public function cidade(): BelongsTo
    {
        return $this->belongsTo(Cidade::class, 'cidade_id');
    }

    public function produtos()
    {
        //return $this->hasMany(produtos::class);
    }
}
