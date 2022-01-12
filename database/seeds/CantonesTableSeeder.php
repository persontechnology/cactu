<?php

use Illuminate\Database\Seeder;
use cactu\Models\Localidad\Canton;
use cactu\Models\Localidad\Provincia;

class CantonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // cantones de tungurahua
        $tungurahua=Provincia::where('nombre','TUNGURAHUA')->first();

        $cantonesTungurahua = array(
            'AMBATO',
            'BAÑOS DE AGUA SANTA',
            'CEVALLOS',
            'MOCHA',
            'PATATE',
            'QUERO',
            'SAN PEDRO DE PELILEO',
            'SANTIAGO DE PÍLLARO',
            'TISALEO',
        );
        $ict=1;
        foreach ($cantonesTungurahua as $ct) {
            Canton::updateOrCreate([
                'nombre' => $ct,
                'codigo' => $tungurahua->codigo.'-0'.$ict,
                'provincia_id'=>$tungurahua->id
            ]);
            $ict++;
        }


        // cantones de cotopaxi
        $cotopaxi=Provincia::where('nombre','COTOPAXI')->first();
        $cantonesCotopaxi = array(
            'LATACUNGA',
            'LA MANÁ',
            'PANGUA',
            'PUJILI',
            'SALCEDO',
            'SAQUISILÍ',
            'SIGCHOS',
        );
        $icc=1;
        foreach ($cantonesCotopaxi as $cc) {
            Canton::updateOrCreate([
                'nombre'=>$cc,
                'codigo'=>$cotopaxi->codigo.'-0'.$icc,
                'provincia_id'=>$cotopaxi->id
            ]);
            $icc++;
        }



    }
}
