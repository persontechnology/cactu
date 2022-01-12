<?php

use Illuminate\Database\Seeder;
use cactu\Models\Localidad\Canton;
use cactu\Models\Localidad\Comunidad;
use cactu\User;

class ComunidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario=User::where('email','svilcacundo@cactu.org.ec')->first();
        $cantonLatacunga=Canton::where('nombre','Latacunga')->first();
        $cantonAmbato=Canton::where('nombre','Ambato')->first();
        Comunidad::updateOrCreate([
            'nombre'=>'CACTU-COTOPAXI',
            'codigo'=>$cantonLatacunga->codigo.'-01',
            'canton_id'=>$cantonLatacunga->id,
            'user_id'=>$usuario->id
        ]);
        Comunidad::updateOrCreate([
            'nombre'=>'CACTU-TUNGURAHUA',
            'codigo'=>$cantonAmbato->codigo.'-01',
            'canton_id'=>$cantonAmbato->id,
            'user_id'=>$usuario->id
        ]);

    }
}
