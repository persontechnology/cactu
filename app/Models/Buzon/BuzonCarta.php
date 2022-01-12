<?php

namespace cactu\Models\Buzon;
use cactu\Models\Buzon\Buzon;
use cactu\Models\Buzon\TipoCarta;
use Illuminate\Database\Eloquent\Model;

class BuzonCarta extends Model
{
    protected $table="buzon_cartas";
    public function buzon()
    {
        return $this->belongsTo(Buzon::class,'buzon_id');
    }
    public function tipoCarta()
    {
        return $this->belongsTo(TipoCarta::class,'tipo_cartas_id');
    }
    public function buzonCartaBoletas()
    {
        return $this->hasMany(BuzonCartaBoleta::class,'buzon_cartas_id');
    }
   
}
