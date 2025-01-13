<?php

namespace Database\Seeders;

use App\Models\Transportadora;
use Illuminate\Database\Seeder;

class TransportadoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transportadora::create([
            'nome' => 'Transportadora 01',
            'razao_social' => 'Transportadora 01 LTDA',
        ]);
        Transportadora::create([
            'nome' => 'Transportadora 02',
            'razao_social' => 'Transportadora 02 LTDA',
        ]);
    }
}
