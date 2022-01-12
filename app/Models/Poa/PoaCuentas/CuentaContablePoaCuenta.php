<?php

namespace cactu\Models\Poa\PoaCuentas;

use Illuminate\Database\Eloquent\Model;
use cactu\Models\Mes;
use cactu\Models\Poa\PoaCuentas\PoaContable;
use cactu\Models\CuentaContable;
use cactu\Models\Poa\PoaCuentas\PoaCuentaContableMes;
use cactu\Models\Registro\Listado;

class CuentaContablePoaCuenta extends Model
{
     protected $table = 'cuentaContablePoaCuenta';

      public function poaContable()
    {
        return $this->belongsTo(PoaContable::class, 'poaContable_id');
    }
    public function meses()
    {
        return $this->belongsToMany(Mes::class, 'poaCuentaContableMes', 'cuentaContablePoaCuenta_id', 'mes_id')
        ->as('poaCuentaContableMes')
        ->withPivot(['id','valor']);
    }
    

    

     public function cuentaContable()
    {
        return $this->belongsTo(CuentaContable::class, 'cuentaContable_id');
    }

    public function buscarCuentaContable($idCuentaContable)
    {
      return CuentaContable::findOrFail($idCuentaContable);
    }
    public function mesesCuenta()
    {
       return $this->hasMany(PoaCuentaContableMes::class,'cuentaContablePoaCuenta_id');
    }


    
   
}
