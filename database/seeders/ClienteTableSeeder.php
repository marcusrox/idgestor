<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteTableSeeder extends Seeder
{

    public function run()
    {
        //DB::table('vendedores')->delete();

        Cliente::firstOrCreate(array(
            'tipo_pessoa' => 'F',
            'nome' => 'Mário Cliente da Silva',
            'cpf_cnpj' => '913.150.720-41',
            'celular' => '(71) 98888-5566',
            'endereco' => 'Rua do Vendedor',
            'numero' => '123',
            'bairro' => 'Bairro do Vendedor',
            'cep' => '40000-000',
            'cidade' => 'Salvador',
            'uf_id' => '1',
            'user_id' => '2',
            'created_by' => 1,
            'updated_by' => 1,
        ));

        Cliente::firstOrCreate(array(
            'tipo_pessoa' => 'J',
            'nome' => 'Fazenda Cliente',
            'cpf_cnpj' => '56.843.760/0001-15',
            'razao_social' => 'Fazenda Cliente LTDA',
            'celular' => '(71) 98888-5566',
            'endereco' => 'Rua do Vendedor',
            'numero' => '123',
            'bairro' => 'Bairro do Vendedor',
            'cep' => '40000-000',
            'cidade' => 'Salvador',
            'uf_id' => '1',
            'user_id' => '3',
            'created_by' => 1,
            'updated_by' => 1,
        ));
    }
}
