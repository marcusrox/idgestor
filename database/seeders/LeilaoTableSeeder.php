<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Leilao;
use Carbon\Carbon;

class LeilaoTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('leiloes')->delete();

		// SeedLeiloes
		Leilao::create(array(
            'nome' => '1º Grande Leilão de Equinos da Fenadro 2020',
            'dt_leilao_de' => Carbon::parse('2020-01-01'),
            'dt_leilao_ate' => Carbon::parse('2020-01-01'),
            'nome_organizador' => 'Sindicato Rural de Sarador',
            'local_leilao' => 'Parque de Exposições Campolino Brito',
            'html_descricao' => 'Uma longa descrição desejada sobre esse leilão, incluindo formatação HTML',
            ));

        Leilao::create(array(
            'nome' => '2º Leilão Virtual União das Raças',
            'dt_leilao_de' => Carbon::parse('2020-01-01'),
            'dt_leilao_ate' => Carbon::parse('2020-01-15'),
            'nome_organizador' => 'Canal Bussiness',
            'local_leilao' => 'www.canalbusiness.com.br',
            'html_descricao' => 'Uma longa descrição desejada sobre esse leilão, incluindo formatação HTML',
        ));
	}
}