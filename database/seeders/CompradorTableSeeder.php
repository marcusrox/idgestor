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
            'tipo_pessoa' => 'F',
            'nome' => 'Mário Comprador da Silva',
            'cpf_cnpj' => '913.150.720-41',
            'celular' => '(71) 98888-5566',
            'endereco' => 'Rua do Vendedor',
            'numero' => '123',
            'bairro' => 'Bairro do Vendedor',
            'cep' => '40000-000',
            'cidade' => 'Salvador',
            'uf' => 'BA',
            'user_id' => '2',
            'created_by' => 1,
            'updated_by' => 1,
        ));

        Comprador::firstOrCreate(array(
            'tipo_pessoa' => 'J',
            'nome' => 'Fazenda Compradora',
            'cpf_cnpj' => '56.843.760/0001-15',
            'razao_social' => 'Fazenda Compradora LTDA',
            'celular' => '(71) 98888-5566',
            'endereco' => 'Rua do Vendedor',
            'numero' => '123',
            'bairro' => 'Bairro do Vendedor',
            'cep' => '40000-000',
            'cidade' => 'Salvador',
            'uf' => 'BA',
            'user_id' => '3',
            'created_by' => 1,
            'updated_by' => 1,
        ));
    }
}
