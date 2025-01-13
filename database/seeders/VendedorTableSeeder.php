<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendedor;

class VendedorTableSeeder extends Seeder
{

    public function run()
    {
        //DB::table('vendedores')->delete();

        // SeedVendedores
        Vendedor::firstOrCreate(array(
            'tipo_pessoa' => 'F',
            'nome' => 'Lucas Vendedor da Silva',
            'cpf_cnpj' => '881.425.700-09',
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
        Vendedor::firstOrCreate(array(
            'tipo_pessoa' => 'J',
            'nome' => 'Rancho Fundo',
            'cpf_cnpj' => '98.310.508/0001-90',
            'razao_social' => 'Rancho Fundo LTDA',
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
