<?php

namespace cactu\Models;

use Illuminate\Database\Eloquent\Model;
use cactu\Models\PlanificacionModelo;
use cactu\Models\Poa\Poa;

class Planificacion extends Model
{
    protected $table="planificacion";

    protected $fillable = [
        'desde', 'hasta', 'estado',
    ];

    public function planificacionModelos()
    {
       return $this->hasMany(PlanificacionModelo::class,'planificacion_id');
    }



    // 
    public function poas()
    {
        return $this->hasManyThrough(
            Poa::class,
            PlanificacionModelo::class,
            'planificacion_id', // Foreign key on planificacion modelos table...
            'planificacionModelo_id', // Foreign key on poa table...
            'id', // Local key on planificacion table...
            'id' // Local key on planificacion modelo table...
        );
    }
}
