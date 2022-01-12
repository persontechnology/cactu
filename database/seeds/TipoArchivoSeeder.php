<?php

use cactu\Models\TipoArchivo;
use Illuminate\Database\Seeder;

class TipoArchivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        TipoArchivo::updateOrCreate(['nombre'=>'F2']);
        TipoArchivo::updateOrCreate(['nombre'=>'Reportes']);
        TipoArchivo::updateOrCreate(['nombre'=>'Partida']);
        TipoArchivo::updateOrCreate(['nombre'=>'CS']);
        TipoArchivo::updateOrCreate(['nombre'=>'Ficha']);
        TipoArchivo::updateOrCreate(['nombre'=>'FAV']);
        TipoArchivo::updateOrCreate(['nombre'=>'Matricula']);
        TipoArchivo::updateOrCreate(['nombre'=>'Otros']);
    }
}
