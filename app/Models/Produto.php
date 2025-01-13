<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';
    protected $guarded = []; // Não precisa colocar os campos no fillable

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }

    public function itensVendas()
    {
        //return $this->morphMany(ItemVenda::class, 'item');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
