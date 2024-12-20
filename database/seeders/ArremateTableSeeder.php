<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Arremate;

class ArremateTableSeeder extends Seeder
{

    public function run()
    {

        Arremate::firstOrCreate(array(
            'lote_id' => '1',
            'forma_pagamento_id' => '2',
            'comprador_id' => '1',
            'dt_primeiro_pagamento' => '2019-11-01',
            'vl_parcela' => 4.00,
            'created_by' => 1,
            'updated_by' => 1,
        ));

        Arremate::firstOrCreate(array(
            'lote_id' => '2',
            'forma_pagamento_id' => '3',
            'comprador_id' => '2',
            'dt_primeiro_pagamento' => '2019-12-01',
            'vl_parcela' => 3.00,
            'created_by' => 1,
            'updated_by' => 1,
        ));
    }
}
