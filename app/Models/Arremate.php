<?php

namespace App\Models;

class Arremate extends BaseModel 
{

    protected $table = 'arremates';
    public $timestamps = true;

    protected $fillable = ['lote_id', 'forma_pagamento_id', 'comprador_id', 'dt_primeiro_pagamento', 'vl_parcela'];

    // Os campos abaixo serão automaticamnte convertidos para Carbon pelo eloquent
    protected $dates = [
        'dt_primeiro_pagamento',
    ];

    public function parcelas()
    {
        return $this->hasMany('App\Models\Parcela');
    }

    public function comprador()
    {
        return $this->belongsTo('App\Models\Comprador');
    }

    public function lote()
    {
        return $this->belongsTo('App\Models\Lote');
    }

    public function forma_pagamento()
    {
        return $this->belongsTo('App\Models\FormaPagamento');
    }

    public function rules()
    {
        return [
            'lote_id' => 'required',
            'forma_pagamento_id' => 'required',
            'comprador_id' => 'required',
            'dt_primeiro_pagamento' => 'required',
        ];
    }

}