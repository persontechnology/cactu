<?php

namespace cactu\Models;
use cactu\Models\Actividad;
use cactu\Models\Modulo;
use Illuminate\Database\Eloquent\Model;
/*Autor: Fabian Lopez*/
/*descripcion este model se gestinará los modelos programaticos*/
class ModeloProgramatico extends Model
{
     protected $table = 'modeloProgramatico';

     protected $fillable = [
        'nombre', 'codigo','usuarioCreado','usuarioActualizado',
    ];
    public function actividades()
    {
    	  return $this->hasMany(Actividad::class,'modeloProgramatico_id')->orderBy('codigo');
    }
    public function modulos()
    {
    	  return $this->hasMany(Modulo::class,'modeloProgramatico_id')->orderBy('nombre');
    }
}
