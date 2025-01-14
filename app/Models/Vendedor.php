<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vendedor extends BaseModel
{
    use UserstampTrait;

    protected $table = 'vendedores';


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

    public function uf(): BelongsTo
    {
        return $this->belongsTo(Uf::class, 'uf_id');
    }

    public function cidade(): BelongsTo
    {
        return $this->belongsTo(Cidade::class, 'cidade_id');
    }

    public function lotes(): HasMany
    {
        return $this->hasMany('App\Models\Lote');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }
}
