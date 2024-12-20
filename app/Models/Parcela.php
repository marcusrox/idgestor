<?php

namespace App\Models;

use App\Models\Enum;

class Parcela extends BaseModel 
{
    protected $table = 'parcelas';
    public $timestamps = true;
    
    protected $dates = [
        'dt_liquidacao',
        'dt_vencimento',
    ];

    protected $fillable = [
        'arremate_id', 
        'nu_parcela', 
        'dt_vencimento', 
        'vl_parcela', 
        'vl_desconto', 
        'vl_pago',
        'st_parcela', 
        'dt_liquidacao'
    ];

    public function arremate()
    {
        return $this->belongsTo('App\Models\Arremate');
    }

    public function boletos()
    {
        return $this->hasMany('App\Models\Boleto');
    }

    public function pagamentos()
    {
        return $this->hasMany('App\Models\Pagamento');
    }

    public function atualizarPosPagamento() {
        // Obter dados dos pagamentos para a parcela
        $vl_pagamento_total = $this->pagamentos()->sum("vl_pagamento");
        $dt_pagamento_max = $this->pagamentos()->max("dt_pagamento");

        // Caso os valores registrados para as parcelas forem maior ou igual que o valor da parcela, considerar Liquidada
        if ($vl_pagamento_total >= $this->vl_parcela) {
            $this->st_parcela = "LQ"; // 'Liquidada'
            $this->dt_liquidacao = $dt_pagamento_max;
            $this->vl_pago = $vl_pagamento_total;
            $this->save();
        // Caso os valores registrados para as parcelas menor q o valor da parcela, considerar pagamento parcial
        } elseif (($vl_pagamento_total <> 0) && ($vl_pagamento_total < $this->vl_parcela)) {
            $this->st_parcela = "PP"; // 'Liquidada'
            $this->vl_pago = $vl_pagamento_total;
            $this->save();
        }
        
    }

}
