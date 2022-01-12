<?php

use cactu\Models\Buzon\TipoCarta;
use Illuminate\Database\Seeder;

class TipoCartaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoCarta::updateOrCreate([
            'nombre' => 'Contestación',
            'imagen'=>'1',
            'imagenes'=>1,
            'letras'=>'0',
            'imagenesres'=>1,
            'archivo'=>'1',
                       
        ]);
        TipoCarta::updateOrCreate([
            'nombre' => 'Presentación',
            'imagen'=>'1',
            'imagenes'=>2,
            'imagenesres'=>2,
            'letras'=>'1'
                       
        ]);
        TipoCarta::updateOrCreate([
            'nombre' => 'Unión',
            'imagen'=>'1',
            'imagenes'=>1,
            'imagenesres'=>1,
            'letras'=>'0'
                       
        ]);

        TipoCarta::updateOrCreate([
            'nombre' => 'Agradecimiento',
            'imagen'=>'1',
            'imagenes'=>1,
            'imagenesres'=>1,
            'letras'=>'0'
                       
        ]);
        TipoCarta::updateOrCreate([
            'nombre' => 'Iniciadas',
            'imagen'=>'1',
            'imagenes'=>1,
            'imagenesres'=>1,
            'letras'=>'0'
                       
        ]);
    }
}
