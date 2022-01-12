<?php

namespace cactu\Models\Poa;

use Illuminate\Database\Eloquent\Model;
use cactu\Models\Mes;
use cactu\Models\TipoActividad;


class PoaActividad extends Model
{
    protected $table='poaActividad';

    
    // A:Deivid
    // D:de poaActividad a tabla media poaActividadMes a tabla final mes
    public function meses()
    {
        return $this->belongsToMany(Mes::class, 'poaActividadMes', 'poaActividad_id', 'mes_id')
        ->as('poaActividadMes')
        ->withPivot(['id','valor']);
    }


    // autor:deivid
    // d: consultar poaactividadmes por mes y por valor > 0
    public function mesesXmes($mes_nombre)
    {
        $mes=Mes::where('mes',$mes_nombre)->first();
        return $this->belongsToMany(Mes::class, 'poaActividadMes', 'poaActividad_id', 'mes_id')
        ->as('poaActividadMes')
        ->wherePivot('mes_id',$mes->id)
        ->wherePivot('valor','>',0)
        ->withPivot(['id','valor','mes_id'])->first();
    }
    
       public function mesesConsula()
    {
        $meses = Mes::get()->pluck('mes');
        $mesActual= $meses[date('n')-1];
        return $this->belongsToMany(Mes::class, 'poaActividadMes', 'poaActividad_id', 'mes_id')
        ->as('poaActividadMes')
        ->withPivot(['id','valor'])
        ->wherePivot('valor','>',0)
        ->where('mes',$mesActual);
    }

    public function poa()
    {
        return $this->belongsTo(Poa::class, 'poa_id');
    }

    // A:Deivid
    // D: un poactividad retrocede a tipo de actividad
    public function tipoActividad()
    {
        return $this->belongsTo(TipoActividad::class, 'tipoActividad_id');
    }
     // A:Deivid
    // D: un poactividad retrocede a tipo de actividad

    public function poActividadesMeses()
    {
          return $this->hasMany(Actividad::class,'modeloProgramatico_id')->orderBy('codigo');
    }
   

   


}
