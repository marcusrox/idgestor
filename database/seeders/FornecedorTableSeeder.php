<?php

namespace Database\Seeders;

use App\Models\Fornecedor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FornecedorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fornecedor::firstOrCreate(array(
            'tipo_pessoa' => 'F',
            'nome' => 'Mário Fornecedor da Silva',
            'cpf_cnpj' => '913.150.720-41',
            'celular' => '(71) 98888-5566',
            'endereco' => 'Rua do Mato Grosso',
            'numero' => '123',
            'bairro' => 'Bairro do Mato',
            'cep' => '40000-000',
            'cidade' => 'Salvador',
            'uf' => 'BA',

            'created_by' => 1,
            'updated_by' => 1,
        ));

        Fornecedor::firstOrCreate(array(
            'tipo_pessoa' => 'J',
            'nome' => 'Fazenda Fornecedor',
            'cpf_cnpj' => '56.843.760/0001-15',
            'razao_social' => 'Fazenda Fornecedor LTDA',
            'celular' => '(71) 98888-5566',
            'endereco' => 'Rua do Oeste',
            'numero' => '123',
            'bairro' => 'Bairro do Oeste',
            'cep' => '40000-000',
            'cidade' => 'Salvador',
            'uf' => 'BA',

            'created_by' => 1,
            'updated_by' => 1,
        ));
    }
}
