<?php

namespace Database\Seeders;

use App\Models\Cidade;
use Illuminate\Database\Seeder;

class CidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cidade::firstOrCreate([
            'nome' => 'Salvador',
            'uf_id' => 5,
        ]);
        Cidade::firstOrCreate([
            'nome' => 'Jequié',
            'uf_id' => 5,
        ]);
        Cidade::firstOrCreate([
            'nome' => 'Aracaju',
            'uf_id' => 25,
        ]);
        Cidade::firstOrCreate([
            'nome' => 'São Paulo',
            'uf_id' => 24,
        ]);
    }
}
