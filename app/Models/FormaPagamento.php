<?php

namespace App\Models;

class FormaPagamento extends BaseModel
{

    protected $table = 'formas_pagamento';

    protected $guarded = []; // Não precisa colocar os campos no fillable

    public function vendas()
    {
        return $this->hasMany('Venda');
    }


    // public function rules()
    // {
    //     return [
    //         'nome' => 'required|unique:formas_pagamento,nome,' . $this->id,
    //         'pct_desconto' => 'required',
    //         'qtd_parcelas' => 'required',
    //         'forma_parcelamento' => 'required',
    //     ];
    // }

    // public function setPctDescontoAttribute($value)
    // {
    //     if (strpos($value, ',') === false) {
    //         $this->attributes['pct_desconto'] = $value;
    //     } else {
    //         $this->attributes['pct_desconto'] = str_replace(',', '.', $value);
    //     }
    // }

    // // TODO: talvez seja melhor trabalhar essa conversão na apresentação, pois posso precisar trabalhar com o atributo do model como numero mesmo
    // public function getPctDescontoAttribute($value)
    // {
    //     if (strpos($value, '.') === false) {
    //         return $value;
    //     } else {
    //         return str_replace('.', ',', $value);
    //     }
    // }

    /*     public function __get($key)
    {

        $excluded = [
            // here you should add primary or foreign keys and other values,
            // that should not be touched.
            // $alternatively define an $included array to whitelist values
            'foreignkey',
        ];
        error_log('$key: ' . $key);
        error_log('$this->attributes: ' . var_export($this->attributes, true));
        // if mutator is defined for an attribute it has precedence.
        if(array_key_exists($key, $this->attributes)
           && ! $this->hasGetMutator($key) && ! in_array($key, $excluded))  {
            return "modified string";
        }

        // let everything else handle the Model class itself
        return parent::__get($key);
    }    */
}
