<?php

namespace cactu\Models;

use Illuminate\Database\Eloquent\Model;
use cactu\Models\ModeloProgramatico;
use cactu\Models\Poa\Poa;
use cactu\Models\Planificacion;
class PlanificacionModelo extends Model
{
    protected $table = 'planificacionModelo';

    public function modeloProgramatico()
    {
    	return $this->belongsTo(ModeloProgramatico::class,'modeloProgramatico_id');
    }

    public function poas()
    {
        return $this->hasMany(Poa::class, 'planificacionModelo_id');
    }

    // regresa a planificacion
    public function planificacion()
    {
    	return $this->belongsTo(Planificacion::class,'planificacion_id');
    }
}
