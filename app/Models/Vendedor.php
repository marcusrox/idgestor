<?php

namespace App\Models;

class Vendedor extends BaseModel
{
    use UserstampTrait;

    protected $table = 'vendedores';

    // // Atributos que serao mostrados no form show
    // public $attrShow = [
    //     'id' => 'ID',
    //     'cpf_cnpj' => 'CPF/CNPJ',
    //     'nome' => 'Nome Fantasia',
    //     'razao_social' => 'Razão Social',
    //     'telefone' => 'Telefone',
    // ];

    protected $guarded = []; // Não precisa colocar os campos no fillable

    // public function rules()
    // {
    //     return [
    //         'cpf_cnpj' => 'required|unique:vendedores,cpf_cnpj,' . $this->id,
    //         'nome' => 'required',
    //         'razao_social' => 'required',
    //         'tipo_pessoa' => 'required',
    //         'telefone' => 'required',
    //         'user_id' => 'required',
    //     ];
    // }

    public function lotes()
    {
        return $this->hasMany('App\Models\Lote');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
