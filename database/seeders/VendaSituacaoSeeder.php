<?php

namespace Database\Seeders;

use App\Models\VendaSituacao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendaSituacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VendaSituacao::firstOrCreate(['nome' => 'Aguardando pagamento']);
        VendaSituacao::firstOrCreate(['nome' => 'Aguardando emissão nota fiscal']);
        VendaSituacao::firstOrCreate(['nome' => 'Cancelado']);
        VendaSituacao::firstOrCreate(['nome' => 'Concluído']);
        VendaSituacao::firstOrCreate(['nome' => 'Pendente']);
        //VendaSituacao::create(['nome' => 'Aguardando Autorização (Mix)']);
        //VendaSituacao::create(['nome' => 'Aguardando Autorização (Inadimplência)']);
        //VendaSituacao::create(['nome' => 'Aguardando Autorização (Bônus)']);
    }
}
