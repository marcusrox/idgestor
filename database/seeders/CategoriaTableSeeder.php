<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::firstOrCreate(array(
            'nome' => 'Motos',
            'codigo' => '01',
            'descricao' => 'Categoria de motos',
            'created_by' => 1,
            'updated_by' => 1,
        ));
        Categoria::firstOrCreate(array(
            'nome' => 'Motos eletricas',
            'codigo' => '01.01',
            'descricao' => 'Categoria de motos eletricas',
            'created_by' => 1,
            'updated_by' => 1,
        ));
        Categoria::firstOrCreate(array(
            'nome' => 'Eletrodomesticos',
            'codigo' => '02',
            'descricao' => 'Categoria de eletronicos',
            'created_by' => 1,
            'updated_by' => 1,
        ));
        Categoria::firstOrCreate(array(
            'nome' => 'Ventiladores',
            'codigo' => '02.01',
            'descricao' => 'Categoria de ventiladores',
            'created_by' => 1,
            'updated_by' => 1,
        ));
    }
}
