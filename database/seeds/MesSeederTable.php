<?php

use Illuminate\Database\Seeder;
use cactu\Models\Mes;

class MesSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        foreach ($meses as $mes) {
            Mes::updateOrCreate(['mes' => $mes]);
        }
    }
}
