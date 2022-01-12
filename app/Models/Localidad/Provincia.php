<?php

namespace cactu\Models\Localidad;

use Illuminate\Database\Eloquent\Model;
use cactu\Models\Localidad\Canton;
use cactu\User;

class Provincia extends Model
{
    protected $table='provincia';

    protected $fillable = [
        'nombre', 'codigo',
    ];

    public function cantones()
    {
        return $this->hasMany(Canton::class);
    }

    // A:Deivid
    // D: una provincia tiene coordinadores
    public function coordinadores()
    {
        return $this->belongsToMany(User::class, 'coordinador', 'provincia_id', 'user_id')
        ->as('coordinador')
        ->withPivot(['id']);
    } 
}
