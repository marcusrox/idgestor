<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Pagamento extends BaseModel
{

    protected $guarded = []; // Não precisa colocar os campos no fillable

    protected $table = 'pagamentos';

    use SoftDeletes;

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function parcela()
    {
        return $this->belongsTo('App\Models\Parcela');
    }
}
