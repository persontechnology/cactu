<?php

namespace cactu\Models\Buzon;

use cactu\Models\Ninio;
use Illuminate\Database\Eloquent\Model;

class Buzon extends Model
{
    protected $table="buzons";
    
    public function buzonCartas()
    {
        return $this->belongsToMany(TipoCarta::class,'buzon_cartas','buzon_id','tipo_cartas_id')
        ->as('cartasBuzon')->withPivot(['id','archivo','estado','imagen','imagen2','respuesta','buzon_id','tipo_cartas_id','created_at','updated_at']);
    }
    public function buzonCartasNinio()
    {
        return $this->belongsToMany(TipoCarta::class,'buzon_cartas','buzon_id','tipo_cartas_id')
        ->as('cartasBuzon')->withPivot(['id','archivo','estado','imagen','imagen2','respuesta','buzon_id','tipo_cartas_id','created_at','updated_at']);
        // ->wherePivot('estado','!=','Respondida');
    }
    public function ninio()
    {
        return $this->belongsTo(Ninio::class,'ninio_id');
    }
}
