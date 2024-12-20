<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Pagamento extends BaseModel 
{

    protected $fillable = ['parcela_id', 'vl_pagamento', 'dt_pagamento', 'paypal_nonce', 'paypal_transaction_id', 'paypal_transaction_json'];

    protected $table = 'pagamentos';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function parcela()
    {
        return $this->belongsTo('App\Models\Parcela');
    }

}