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
        Role::create([
            'name' => 'Administrador',
            'label' => 'admin'
        ]);
        Role::create([
            'name' => 'Comprador',
            'label' => 'comprador'
        ]);
        Role::create([
            'name' => 'Vendedor',
            'label' => 'vendedor'
        ]);

    }
}
