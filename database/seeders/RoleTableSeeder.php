<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate([
            'name' => 'Administrador',
            //'label' => 'admin'
        ]);
        Role::firstOrCreate([
            'name' => 'Cliente',
            //'label' => 'cliente'
        ]);
        Role::firstOrCreate([
            'name' => 'Vendedor',
            //'label' => 'vendedor'
        ]);
    }
}
