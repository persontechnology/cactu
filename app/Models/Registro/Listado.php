<?php

namespace cactu\Models\Registro;

use cactu\Models\Ninio;
use cactu\Models\Poa\PoaCuentas\CuentaContablePoaCuenta;
use Illuminate\Database\Eloquent\Model;

class Listado extends Model
{
    public function asistencia()
    {
        return $this->belongsTo(Asistencia::class);
    }

    public function ninio()
    {
        return $this->belongsTo(Ninio::class);
    }


    public function cuentaContablePoaCuenta()
    {
        return $this->belongsToMany(CuentaContablePoaCuenta::class, 'listaCuentaContable', 'listado_id', 'cuentaContablePoaCuenta_id')
        ->as('listaCuentaContable');
    }

    public function cuentaContablePoaCuenta_f()
    {
        return $this->belongsToMany(CuentaContablePoaCuenta::class, 'listaCuentaContable', 'listado_id', 'cuentaContablePoaCuenta_id')
        ->as('listaCuentaContable')
        ->where('cuentaContablePoaCuenta_id',3);
    }
    

}
