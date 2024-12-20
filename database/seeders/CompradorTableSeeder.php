<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comprador;

class CompradorTableSeeder extends Seeder
{

    public function run()
    {
        //DB::table('vendedores')->delete();

        Comprador::firstOrCreate(array(
            'cpf_cnpj' => '913.150.720-41',
            'nome' => 'Mário Comprador da Silva',
            'razao_social' => 'Mário Comprador da Silva',
            'tipo_pessoa' => 'F',
            'telefone' => '(71) 98888-5566',
            'user_id' => '3',
            'created_by' => 1,
            'updated_by' => 1,
        ));

        Comprador::firstOrCreate(array(
            'cpf_cnpj' => '222.222.222-22',
            'nome' => 'Jorge Comprador da Silva',
            'razao_social' => 'Jorge Comprador da Silva',
            'tipo_pessoa' => 'F',
            'telefone' => '(71) 98888-5566',
            'user_id' => '4',
            'created_by' => 1,
            'updated_by' => 1,
        ));
    }
}
