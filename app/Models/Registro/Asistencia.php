<?php

namespace cactu\Models\Registro;

use cactu\Models\Poa\PoaParticipantes\ComunidadPoaParticipante;
use cactu\User;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
	  protected $table="asistencias";
    //
    public function comunidadPoaParticipante()
    {
        return $this->belongsTo(ComunidadPoaParticipante::class, 'comunidadPoaParticipante_id');
    } 

    public function listado()
    {
        return $this->hasMany(Listado::class,'asistencia_id');
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'user_id');
    } 
    public function creadoPor()
    {
        return $this->belongsTo(User::class, 'user_id');
    } 
}
