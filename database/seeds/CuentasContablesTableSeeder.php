<?php

use Illuminate\Database\Seeder;
use cactu\Models\CuentaContable;
class CuentasContablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
    {
        $data = array(
            'Refrijerio',
            'Almuerzo',
            'Cena',
            'Transporte',
            'Materiales',
            'Desayuno'
          

        );
        
        foreach ($data as $nombre) {
            CuentaContable::updateOrCreate(['nombre' => $nombre]);
        }
    }

}
