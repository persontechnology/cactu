<?php

namespace cactu\Models\Poa\PoaCuentas;

use Illuminate\Database\Eloquent\Model;
use cactu\Models\Mes;
use cactu\Models\Poa\Poa;
use cactu\Models\CuentaContable;
use cactu\Models\Poa\PoaCuentas\CuentaContablePoaCuenta;

class PoaContable extends Model
{
   protected $table='poaContable';

    
    // A:fabian
    // D:de poaCuentaContable a tabla media poaCuentaContableMes a tabla final mes
   
   
    public function poa()
    {
        return $this->belongsTo(Poa::class, 'poa_id');
    }
    public function cuentasContables()
    {
        return $this->belongsToMany(CuentaContable::class,'cuentaContablePoaCuenta', 'poaContable_id','cuentaContable_id')
        ->as('cuentaContablePoaCuenta')
        ->withPivot('id');
    }
    public function CuentaContablePoaCuentas()
    {
        return $this->hasMany(CuentaContablePoaCuenta::class,'poaContable_id');
    }



}
