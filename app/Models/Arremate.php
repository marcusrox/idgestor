<?php

namespace App\Models;

use Illuminate\Validation\ValidationException;

class Arremate extends BaseModel
{

    protected $table = 'arremates';

    protected $guarded = []; // Não precisa colocar os campos no fillable

    protected static function boot()
    {
        parent::boot();

        // Garantir que um comprador não arremate o mesmo lote mais de uma vez
        static::saving(function ($model) {
            if ($model->exists) { // Se atualizando
                $existeComprador = Arremate::where('lote_id', $model->lote_id)
                    ->where('comprador_id', $model->comprador_id)
                    ->where('id', '<>', $model->id)
                    ->exists();
            } else { // Se criando
                $existeComprador = Arremate::where('lote_id', $model->lote_id)
                    ->where('comprador_id', $model->comprador_id)
                    ->exists();
            }

            if ($existeComprador) {
                throw new \Exception('Este comprador já arrematou este lote.');
                // throw ValidationException::withMessages([
                //     'comprador_id' => 'Este comprador já arrematou este lote.',
                // ]);
            }
        });
    }

    // Os campos abaixo serão automaticamnte convertidos para Carbon pelo eloquent
    protected $casts = [
        'dt_primeiro_pagamento' => 'date',
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

    public static function rules()
    {
        return [
            'lote_id' => 'required',
            'forma_pagamento_id' => 'required',
            'comprador_id' => 'required|unique:arremates,comprador_id,lote_id',
            'dt_primeiro_pagamento' => 'required',
        ];
    }
    public function gerarParcelas()
    {
        $arr_forma_parcelamento = explode('/', $this->forma_pagamento->forma_parcelamento); // exemplo: "0/1/2/3/4/5/6/7/8/9/10/11"
        $nu_parcela = 1;
        $qtd_parcelas_geradas = 0;
        foreach ($arr_forma_parcelamento as $qtd_meses_parcela) {
            $dt_parcela = $this->dt_primeiro_pagamento->addMonths((int)$qtd_meses_parcela);

            $fator_desconto = $this->forma_pagamento->pct_desconto ? ($this->forma_pagamento->pct_desconto / 100) : 0;

            $vl_desconto = $this->vl_parcela * $fator_desconto;
            $p = new Parcela();
            $p->arremate_id = $this->id;
            $p->nu_parcela = $nu_parcela++;
            $p->vl_parcela = $this->vl_parcela - $vl_desconto;
            $p->vl_desconto = $vl_desconto;
            $p->st_parcela = 'AB';
            $p->dt_vencimento = $dt_parcela;
            //dd($p);
            $p->save();
            $qtd_parcelas_geradas++;
            // Proxima data da parcela

        }
        return $qtd_parcelas_geradas;
    }
}
