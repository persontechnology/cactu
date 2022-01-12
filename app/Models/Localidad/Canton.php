<?php

namespace cactu\Models\Localidad;

use Illuminate\Database\Eloquent\Model;
use cactu\Models\Localidad\Provincia;
use cactu\Models\Localidad\Comunidad;
class Canton extends Model
{
    protected $table='canton';

    protected $fillable = [
        'nombre', 'codigo','provincia_id'
    ];

    public function comunidades()
    {
        return $this->hasMany(Comunidad::class);
    }

    public function provincia()
    {
        return $this->belongsTo( Provincia::class , 'provincia_id');
    }


}
