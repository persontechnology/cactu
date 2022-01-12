<?php

namespace cactu\Models;

use Illuminate\Database\Eloquent\Model;

class TipoParticipante extends Model
{
     protected $table = 'tipoParticipante';
     
     public function ninios()
     {
          return $this->hasMany(Ninio::class,'tipoParticipante_id');
     }

}
