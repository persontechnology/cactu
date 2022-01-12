<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin=Role::updateOrCreate(['name' => 'Administrador']);
        Role::updateOrCreate(['name' => 'Coordinador']);
        Role::updateOrCreate(['name' => 'Gestor']);

    }
}
