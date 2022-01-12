<?php

namespace cactu\Models\Poa\PoaParticipantes;

use Illuminate\Database\Eloquent\Model;
use cactu\Models\Mes;
use cactu\Models\Poa\PoaParticipantes\PoaParticipante;
class PoaParticipanteMes extends Model
{
    
    protected $table='poaParticipanteMes';
      public function mes()
    {
        return $this->belongsTo(Mes::class, 'mes_id');
    }

      public function poaParticipante()
    {
        return $this->belongsTo(PoaParticipante::class, 'poaParticipante_id');
    }

}
