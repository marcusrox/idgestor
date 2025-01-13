<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    protected $guarded = []; // Não precisa colocar os campos no fillable

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}
