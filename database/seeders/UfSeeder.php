<?php

namespace Database\Seeders;

use App\Models\Uf;
use Illuminate\Database\Seeder;

class UfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Uf::firstOrCreate(['nome' => 'Acre', 'codigo' => 'AC']);
        Uf::firstOrCreate(['nome' => 'Alagoas', 'codigo' => 'AL']);
        Uf::firstOrCreate(['nome' => 'Amapá', 'codigo' => 'AP']);
        Uf::firstOrCreate(['nome' => 'Amazonas', 'codigo' => 'AM']);
        Uf::firstOrCreate(['nome' => 'Bahia', 'codigo' => 'BA']);
        Uf::firstOrCreate(['nome' => 'Ceará', 'codigo' => 'CE']);
        Uf::firstOrCreate(['nome' => 'Espírito Santo', 'codigo' => 'ES']);
        Uf::firstOrCreate(['nome' => 'Goiás', 'codigo' => 'GO']);
        Uf::firstOrCreate(['nome' => 'Maranhão', 'codigo' => 'MA']);
        Uf::firstOrCreate(['nome' => 'Mato Grosso', 'codigo' => 'MT']);
        Uf::firstOrCreate(['nome' => 'Mato Grosso do Sul', 'codigo' => 'MS']);
        Uf::firstOrCreate(['nome' => 'Minas Gerais', 'codigo' => 'MG']);
        Uf::firstOrCreate(['nome' => 'Pará', 'codigo' => 'PA']);
        Uf::firstOrCreate(['nome' => 'Paraíba', 'codigo' => 'PB']);
        Uf::firstOrCreate(['nome' => 'Paraná', 'codigo' => 'PR']);
        Uf::firstOrCreate(['nome' => 'Pernambuco', 'codigo' => 'PE']);
        Uf::firstOrCreate(['nome' => 'Piauí', 'codigo' => 'PI']);
        Uf::firstOrCreate(['nome' => 'Rio de Janeiro', 'codigo' => 'RJ']);
        Uf::firstOrCreate(['nome' => 'Rio Grande do Norte', 'codigo' => 'RN']);
        Uf::firstOrCreate(['nome' => 'Rio Grande do Sul', 'codigo' => 'RS']);
        Uf::firstOrCreate(['nome' => 'Rondônia', 'codigo' => 'RO']);
        Uf::firstOrCreate(['nome' => 'Roraima', 'codigo' => 'RR']);
        Uf::firstOrCreate(['nome' => 'Santa Catarina', 'codigo' => 'SC']);
        Uf::firstOrCreate(['nome' => 'São Paulo', 'codigo' => 'SP']);
        Uf::firstOrCreate(['nome' => 'Sergipe', 'codigo' => 'SE']);
        Uf::firstOrCreate(['nome' => 'Tocantins', 'codigo' => 'TO']);
        Uf::firstOrCreate(['nome' => 'Distrito Federal', 'codigo' => 'DF']);
    }
}
