<?php

use Illuminate\Database\Seeder;
use cactu\Models\Localidad\Provincia;

class ProvinciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provincia::updateOrCreate([
            'nombre' => 'TUNGURAHUA',
            'codigo' => '01',
        ]);
        Provincia::updateOrCreate([
            'nombre' => 'COTOPAXI',
            'codigo' => '02',
        ]);
    }
}
