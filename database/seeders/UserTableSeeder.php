<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u = User::updateOrCreate(
            [
                'email' => 'suporte@idevs.com.br'
            ],
            [
                'name' => 'Suporte iDev Solutions',
                'password' => bcrypt('12345678')
            ]
        );
        $u->assignRole("Administrador");

        $u = User::updateOrCreate(
            [
                'name' => 'Lucas Vendedor da Silva'
            ],
            [
                'email' => 'lucas@idevs.com.br',
                'password' => bcrypt('12345678')
            ]
        );
        $u->assignRole("Vendedor");

        $u = User::updateOrCreate(
            [
                'name' => 'Mário Comprador da Silva'
            ],
            [
                'email' => 'mario@idevs.com.br',
                'password' => bcrypt('12345678')
            ]
        );
        $u->assignRole("Comprador");

        // Popular com dados fakes
        //factory(User::class, 30)->create();
        if (User::count() < 10) {
            User::factory()->count(10)->create();
        }
    }
}
