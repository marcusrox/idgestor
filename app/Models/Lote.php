<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;

class Lote extends BaseModel
{

    protected $table = 'lotes';
    public $timestamps = true;

    public function rules()
    {
        return [
            'nome' => 'required|unique:lotes,nome,' . $this->id,
            'leilao_id' => 'required',
            'vendedor_id' => 'required',
        ];
    }

    // // Atributos que serao mostrados no form show
    // public $attrShow = [
    //     'id' => 'ID',
    //     'nome' => 'Nome do Lote',
    // ];

    protected $fillable = ['nome', 'vendedor_id', 'leilao_id'];


    public function leilao()
    {
        return $this->belongsTo('App\Models\Leilao');
    }

    public function vendedor()
    {
        return $this->belongsTo('App\Models\Vendedor');
    }

    public function arremates()
    {
        return $this->hasMany('App\Models\Arremate');
    }
}
