<?php

namespace App\Models;

class Leilao extends BaseModel 
{

    protected $table = 'leiloes';
    public $timestamps = true;

    public function rules()
    {
        return [
            'nome' => 'required|unique:leiloes,nome,' . $this->id,
            'nome_organizador' => 'required',
            'dt_leilao_de' => 'required',
            'dt_leilao_ate' => 'required',
        ];
    }

    // Atributos que serao mostrados no form show
    public $attrShow = [
        'id' => 'ID',
        'nome' => 'Nome',
        'nome_organizador' => 'Organizador',
        'local_leilao' => 'Local',
        'html_descricao' => 'Descrição',
        'dt_leilao_de' => 'Data (de)',
        'dt_leilao_ate' => 'Data (até)',
    ];

    protected $fillable = ['nome', 'nome_organizador', 'html_descricao', 'local_leilao', 'dt_leilao_de', 'dt_leilao_ate'];

    public function getTotalLotesAttribute()
    {
       //return $this->hasMany('App\Models\Lote')->whereLeilaoId($this->leilao_id)->count();
       // QUERY montada não funciona direito: select count(*) as aggregate from `lotes` where `lotes`.`leilao_id` = 1 and `lotes`.`leilao_id` is not null and `leilao_id` is null
    }

    public function lotes()
    {
        return $this->hasMany('App\Models\Lote');
    }

}