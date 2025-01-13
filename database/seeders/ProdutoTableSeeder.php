<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdutoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produto::firstOrCreate(array(
            'nome' => 'Ventilador Turbo',
            'codigo' => 'VENT01',
            'descricao' => 'Um ventilador turbo',
            'categoria_id' => 4,
            'preco_custo' => 100.00,
            'preco_venda' => 150.00,
            'estoque_atual' => 10,
            'estoque_minimo' => 5,
            'pct_mc' => 50,
            'fornecedor_id' => 1,

            'created_by' => 1,
            'updated_by' => 1,
        ));
        Produto::firstOrCreate(array(
            'nome' => 'Moto muito louca',
            'codigo' => 'MOTO01',
            'descricao' => 'Uma moto muito louca',
            'categoria_id' => 1,
            'preco_custo' => 10000.00,
            'preco_venda' => 15000.00,
            'estoque_atual' => 1,
            'estoque_minimo' => 1,
            'pct_mc' => 50,
            'fornecedor_id' => 2,

            'created_by' => 1,
            'updated_by' => 1
        ));
    }
}
