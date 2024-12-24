<?php

namespace App\Models;

class Setting extends BaseModel
{

    protected $table = 'settings';

    protected $guarded = []; // Não precisa colocar os campos no fillable
}
