<?php

namespace cactu\Models\Buzon;
use cactu\Models\Buzon\Buzon;
use Illuminate\Database\Eloquent\Model;

class TipoCarta extends Model
{
    protected $table="tipo_cartas";
    //ayuda a tipo al buzon
    public function buzonTipoCarta($id)
    {
        return Buzon::findOrFail($id);
    }
    public function buzonCartaBoletasget($idBuzonCarta)
    {
        return BuzonCartaBoleta::where('buzon_cartas_id',$idBuzonCarta)->get();
    }
}
