<?php

namespace cactu\Models\Buzon;
use cactu\Models\Buzon\BuzonCarta;
use Illuminate\Database\Eloquent\Model;

class BuzonCartaBoleta extends Model
{
    public function buzonCarta()
    {
        return $this->belongsTo(BuzonCarta::class,'buzon_cartas_id');
    }
}
