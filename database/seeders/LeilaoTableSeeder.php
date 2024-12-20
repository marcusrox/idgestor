<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Leilao;
use Carbon\Carbon;

class LeilaoTableSeeder extends Seeder
{

    public function run()
    {
        //DB::table('leiloes')->delete();

        // SeedLeiloes
        Leilao::firstOrCreate(array(
            'nome' => '1º Grande Leilão de Equinos 2020',
            'dt_leilao_de' => Carbon::parse('2024-01-01'),
            'dt_leilao_ate' => Carbon::parse('2024-01-01'),
            'nome_organizador' => 'Sindicato Rural de Salvador',
            'local_leilao' => 'Parque de Exposições Campolino Brito',
            'html_descricao' => 'Uma longa descrição desejada sobre esse leilão, incluindo formatação HTML',
        ));

        Leilao::firstOrCreate(array(
            'nome' => '2º Leilão Virtual União das Raças',
            'dt_leilao_de' => Carbon::parse('2025-01-01'),
            'dt_leilao_ate' => Carbon::parse('2025-01-15'),
            'nome_organizador' => 'Canal Bussiness',
            'local_leilao' => 'www.canalbusiness.com.br',
            'html_descricao' => 'Uma longa descrição desejada sobre esse leilão, incluindo formatação HTML',
        ));
    }
}
