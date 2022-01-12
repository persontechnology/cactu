<?php

use Illuminate\Database\Seeder;
use cactu\Models\TipoActividad;

class TipoActividadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            'Reuniones Internas',
            'Talleres de formación de formadores (ToT)',
            'Talles comunitarios',
            'Actividades en escuelas/Colegios/Centro',
            'Grupos Focales',
            'Ferias comunitarias',
            'Visitas domiciliarias ',
            'Campañas comunitarias',
            'Campañas locales',
            'Campañas Nacionales',
            'Teatro Debate',
            'Foros',
            'Reuniones interinstitucionales',
            'Levantamiento de información en campo',
            'Rendición de cuentas',
        );
        
        foreach ($data as $nombre) {
            TipoActividad::updateOrCreate(['nombre' => $nombre]);
        }
    }
}
