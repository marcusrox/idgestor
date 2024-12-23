<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use Database\Seeders\RoleTableSeeder;
use Database\Seeders\UserTableSeeder;
use Database\Seeders\LeilaoTableSeeder;
use Database\Seeders\VendedorTableSeeder;
use Database\Seeders\LoteTableSeeder;
use Database\Seeders\CompradorTableSeeder;
use Database\Seeders\FormaPagamentoTableSeeder;
use Database\Seeders\ArremateTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // activity()->disableLogging();

        $arr_user = array_merge(
            User::factory()->raw(), // Dados gerados pela fábrica
            [
                // Dado personalizado
                'name' => 'Marcus Moreira de Souza',
                'email' => 'marcus@idevs.com.br',
                'password' => Hash::make('12345678'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'marcus@idevs.com.br'],
            $arr_user // Gera os dados para criação
        );

        //$this->call(RoleTableSeeder::class);
        //$this->command->info('Role table seeded!');

        $this->call(UserTableSeeder::class);
        $this->command->info('User table seeded!');

        $this->call(LeilaoTableSeeder::class);
        $this->command->info('Leilao table seeded!');

        $this->call(VendedorTableSeeder::class);
        $this->command->info('Vendedor table seeded!');

        $this->call(LoteTableSeeder::class);
        $this->command->info('Lote table seeded!');

        $this->call(CompradorTableSeeder::class);
        $this->command->info('Comprador table seeded!');

        $this->call(FormaPagamentoTableSeeder::class);
        $this->command->info('FormaPagamento table seeded!');

        $this->call(ArremateTableSeeder::class);
        $this->command->info('Arremate table seeded!');

        // activity()->enableLogging();

    }
}
