<?php

namespace cactu\Models;

use cactu\Models\Poa\PoaCuentas\CuentaContablePoaCuenta;
use cactu\Models\Registro\ListaCuentaContablePoaCuenta;
use Illuminate\Database\Eloquent\Model;

class CuentaContable extends Model
{
    protected $table = 'cuentaContable';

    public function total($idsListado,$idCuentaContablePoaCuenta)
    {   
        $total=ListaCuentaContablePoaCuenta::whereIn('listado_id',$idsListado)->where('cuentaContablePoaCuenta_id',$idCuentaContablePoaCuenta)->get();
        if(count($total)>0){
            return count($total);
        }else{
            return 0;
        }
    }
}
