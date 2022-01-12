<?php

namespace cactu\Models;
use cactu\Models\Ninio;
use cactu\Models\TipoArchivo;
use Illuminate\Database\Eloquent\Model;

class CarpetaNinio extends Model
{
    protected $table="carpeta_ninios";
    public function tipoArchivo()
    {
        return $this->belongsTo(TipoArchivo::class,'tipoarchivo_id');
    }
    public function ninio()
    {
    	return $this->belongsTo(Ninio::class,'ninio_id');
    }
}
