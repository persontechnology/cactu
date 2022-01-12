<?php

namespace cactu\Models\Poa\PoaParticipantes;

use cactu\Models\Localidad\Comunidad;
use cactu\Models\Poa\PoaParticipantes\PoaParticipante;
use cactu\Models\Registro\Asistencia;
use cactu\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use cactu\Models\Registro\Listado;


class ComunidadPoaParticipante extends Model
{
    protected $table='comunidadPoaParticipante';
    
    public function poaParticipante()
    {
        return $this->belongsTo(PoaParticipante::class, 'poaParticipante_id');
    }


    public function comunidad()
    {
        return $this->belongsTo(Comunidad::class, 'comunidad_id');
    }

   //A:Deivid
   //D:un comunidadpoaparticipante tien varias asistencias
    public function asisHoyEstadoCreado()
    {
        return $this->hasMany(Asistencia::class,'comunidadPoaParticipante_id')
        ->where('estado','Creado')
        ->where('fecha',Carbon::now()->toDateString());
    }

    // A:deivid
    // D:comunidadpoaparticipante titne varias asistencias
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class,'comunidadPoaParticipante_id')->orderBy('fecha','desc');
    }
      // A:Fabian
    // D:de poaParticipante a tabla media comunidadPoaParticipante a tabla final listado
    public function listados()
    {
        return $this->belongsToMany(Listado::class, 'asistencias', 'comunidadPoaParticipante_id', 'asistencia_id')
        ->as('asistencias');
    }

}
