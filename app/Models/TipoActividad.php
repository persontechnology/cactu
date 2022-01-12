<?php

namespace cactu\Models;

use Illuminate\Database\Eloquent\Model;

class TipoActividad extends Model
{
    protected $table='tipoActividad';
    
    protected $fillable = [
        'nombre'
    ];
}
