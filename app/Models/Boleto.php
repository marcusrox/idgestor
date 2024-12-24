<?php

namespace App\Models;

class Boleto extends BaseModel
{

    protected $table = 'boletos';

    protected $guarded = []; // Não precisa colocar os campos no fillable

    public function parcela()
    {
        return $this->belongsTo('Parcela');
    }
}
