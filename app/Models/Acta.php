<?php

namespace cactu\Models;
use cactu\Models\CuentaContableMesMaterial;
use cactu\Models\Poa\PoaCuentas\PoaCuentaContableMes;
use cactu\Models\Poa\PoaParticipantes\ComunidadPoaParticipante;
use cactu\User;
use Illuminate\Database\Eloquent\Model;

class Acta extends Model
{
    
    function listadoMateriales()
    {
        return $this->hasMany(CuentaContableMesMaterial::class,'acta_id');
    }
    public function comunidadActa()
    {
        return $this->belongsTo(ComunidadPoaParticipante::class,'comunidadPoaParticipante_id');
    }
    public function poaCuentaContableMes()
    {
        return $this->belongsTo(PoaCuentaContableMes::class,'poaCuentaContableMes_id');
    }
    public function gestor()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
