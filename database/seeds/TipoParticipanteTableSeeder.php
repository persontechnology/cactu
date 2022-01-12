<?php

use Illuminate\Database\Seeder;
use cactu\Models\TipoParticipante;

class TipoParticipanteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoParticipante::updateOrCreate([
            'nombre' => 'INNAJ Inscritos/afiliados',
            'estado'=>true,            
        ]);
        TipoParticipante::updateOrCreate([
            'nombre' => 'Participante socio local',
            'estado'=>true,            
        ]);

        TipoParticipante::updateOrCreate([
            'nombre' => 'Comunitario',
            'estado'=>true,            
        ]);
        
    }
}
