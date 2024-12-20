<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['user_id', 'logon_at', 'ip_addr', 'user_agent'];
}
