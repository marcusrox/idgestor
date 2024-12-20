<?php

namespace App\Models;

class Enum {
    public $tiposPessoas = ['F' => 'Física', 'J' => 'Jurídica'];

    public $statusParcelas = ['AB' => 'Em aberto', 'LQ' => 'Liquidada', 'PP' => 'Paga Parcialmente', 'LB' => 'Liberada', 'RN' => 'Renegociada'];
    
}