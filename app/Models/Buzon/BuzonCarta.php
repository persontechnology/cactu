<?php

namespace cactu\Models\Buzon;
use cactu\Models\Buzon\Buzon;
use cactu\Models\Buzon\TipoCarta;
use Carbon\Carbon;
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

    public function getFechaMAttribute($value)
    {
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha = Carbon::parse($this->created_at);
        $mes = $meses[($fecha->format('n')) - 1];
        return $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y');
    }
   
}
