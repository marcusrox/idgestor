<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Venda extends BaseModel
{

    protected $table = 'vendas';
    protected $guarded = []; // Não precisa colocar os campos no fillable

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            // Setar valor padrão para venda_situacao_id
            $model->venda_situacao_id = 1;
        });
        self::updating(function ($model) {
            //
        });
        self::deleting(function ($model) {
            //
        });
    }

    public function vendedor(): BelongsTo
    {
        return $this->belongsTo(Vendedor::class);
    }

    public function itens(): HasMany
    {
        return $this->hasMany(VendaItem::class);
    }

    // Accessor para somar os valores dos itens
    public function getValorTotalAttribute()
    {
        return $this->items->sum(function ($item) {
            return $item->qtd_itens * $item->preco_venda;
        });
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function transportadora(): BelongsTo
    {
        return $this->belongsTo(Transportadora::class);
    }

    public function forma_pagamento(): BelongsTo
    {
        return $this->belongsTo(FormaPagamento::class);
    }
}
