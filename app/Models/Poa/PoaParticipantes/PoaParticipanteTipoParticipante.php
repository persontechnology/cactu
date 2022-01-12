<?php

namespace cactu\Models\Poa\PoaParticipantes;

use Illuminate\Database\Eloquent\Model;
use cactu\Models\Poa\PoaParticipantes\PoaParticipante;
use cactu\Models\TipoParticipante;

class PoaParticipanteTipoParticipante extends Model
{
    protected $table='poaParticipanteTipoParticipante';
    
    
    public function poaParticipante()
    {
        return $this->belongsTo(PoaParticipante::class, 'poaParticipante_id');
    }
    public function tipoParticipante()
    {
        return $this->belongsTo(TipoParticipante::class, 'tipoParticipante_id');
    }

}
