<?php

namespace cactu\Models\Usuario;

use Illuminate\Database\Eloquent\Model;
use cactu\User;
use cactu\Models\Localidad\Provincia;

class Coordinador extends Model
{
    protected $table='coordinador';
    
    protected $fillable = [
        'provincia_id', 'user_id', 'estado',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class, 'provincia_id');
    }

}
