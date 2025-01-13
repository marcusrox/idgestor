<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\User;
use App\Models\VendaSituacao;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use Database\Seeders\RoleTableSeeder;
use Database\Seeders\UserTableSeeder;
use Database\Seeders\FornecedorTableSeeder;
use Database\Seeders\ClienteTableSeeder;
use Database\Seeders\FormaPagamentoTableSeeder;

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

        $this->call(RoleTableSeeder::class);
        $this->command->info('Role table seeded!');

        $this->call(UserTableSeeder::class);
        $this->command->info('User table seeded!');

        $this->call(UfSeeder::class);
        $this->command->info('Uf table seeded!');

        $this->call(CidadeSeeder::class);
        $this->command->info('Cidade table seeded!');

        $this->call(FornecedorTableSeeder::class);
        $this->command->info('Fornecedor table seeded!');

        $this->call(VendedorTableSeeder::class);
        $this->command->info('Vendedor table seeded!');

        $this->call(CategoriaTableSeeder::class);
        $this->command->info('Categoria table seeded!');

        $this->call(ProdutoTableSeeder::class);
        $this->command->info('Produto table seeded!');

        $this->call(ClienteTableSeeder::class);
        $this->command->info('Cliente table seeded!');

        $this->call(FormaPagamentoTableSeeder::class);
        $this->command->info('FormaPagamento table seeded!');

        $this->call(VendaSituacaoSeeder::class);
        $this->command->info('VendaSituacao table seeded!');


        // $this->call(VendaTableSeeder::class);
        // $this->command->info('Venda table seeded!');

        // activity()->enableLogging();

    }
}
