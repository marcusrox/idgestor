<?php

namespace App\Models;

class Boleto extends BaseModel 
{

    protected $table = 'boletos';
    public $timestamps = true;

    public function parcela()
    {
        return $this->belongsTo('Parcela');
    }

}