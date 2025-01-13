<?php

namespace App\Models;

class Fornecedor extends BaseModel
{
    protected $table = 'fornecedores';
    protected $guarded = []; // Não precisa colocar os campos no fillable

    public function produtos()
    {
        //return $this->hasMany(produtos::class);
    }
}
