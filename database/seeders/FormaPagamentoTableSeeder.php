<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FormaPagamento;

class FormaPagamentoTableSeeder extends Seeder
{

    public function run()
    {

        FormaPagamento::firstOrCreate(array(
            'nome' => 'Á vista, 20% de desconto',
            'pct_desconto' => '20',
            'qtd_parcelas' => '1',
            'forma_parcelamento' => '0',
            'created_by' => 1,
            'updated_by' => 1,
        ));
        FormaPagamento::firstOrCreate(array(
            'nome' => '12 parcelas mensais e consecutivas',
            'pct_desconto' => '0',
            'qtd_parcelas' => '12',
            'forma_parcelamento' => '0|1|2|3|4|5|6|7|8|9|10|11',
            'created_by' => 1,
            'updated_by' => 1,
        ));
        FormaPagamento::firstOrCreate(array(
            'nome' => '36 parcelas mensais e consecutivas',
            'pct_desconto' => '0',
            'qtd_parcelas' => '36',
            'forma_parcelamento' => '0|1|2|3|4|5|6|7|8|9|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25|26|27|28|29|30|31|32|33|34|35',
            'created_by' => 1,
            'updated_by' => 1,
        ));
    }
}
