<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $keyType = 'string';

    protected $guarded = []; // Não precisa colocar os campos no fillable

    public function markAsRead()
    {
        $this->update(['read_at' => now()]);
    }

    protected $casts = [
        'data' => 'json', // array Ou 'json'
        'id' => 'string',
    ];

    // public function getTitleAttribute()
    // {
    //     return $this->data['title'] ?? 'N/A';
    // }
    // public function getBodyAttribute()
    // {
    //     return $this->data['body'] ?? 'N/A';
    // }
}
