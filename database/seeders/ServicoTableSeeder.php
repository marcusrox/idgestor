<?php

namespace Database\Seeders;

use App\Models\Servico;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Servico::firstOrCreate(array(
            'nome' => 'Montar computador',
            'descricao' => 'Montagem de computador com peças da loja.',
            'preco' => 100.00,
            'tempo' => 120,

            'created_by' => 1,
            'updated_by' => 1,
        ));
    }
}
