<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lote;

class LoteTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('lotes')->delete();

        // SeedLotes
        
		Lote::create(array(
            'nome' => 'Lote 01 - Vera Cruz',
            'leilao_id' => 1,
            'vendedor_id' => 1,
            
        ));
        
        Lote::create(array(
            'nome' => 'Lote 02 - Boi Gordo',
            'leilao_id' => 1,
            'vendedor_id' => 1,
            
        ));

        Lote::create(array(
            'nome' => 'Lote 01 - Jegue Magro',
            'leilao_id' => 2,
            'vendedor_id' => 1,
            
        ));
	}
}