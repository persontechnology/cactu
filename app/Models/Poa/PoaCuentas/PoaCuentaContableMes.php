<?php

namespace cactu\Models\Poa\PoaCuentas;

use Illuminate\Database\Eloquent\Model;
use cactu\Models\Mes;
use cactu\Models\Poa\PoaCuentas\CuentaContablePoaCuenta;

class PoaCuentaContableMes extends Model
{
  	protected $table='poaCuentaContableMes';

  	 public function mes()
    {
        return $this->belongsTo(Mes::class, 'mes_id');
    }
     public function cuentaContablePoaCuenta()
    {
        return $this->belongsTo(CuentaContablePoaCuenta::class, 'cuentaContablePoaCuenta_id');
    }


    // A: deivid
    // D:obtener ceuntacontableMes
    public function obtenerPorId($id)
    {
        return $this::findOrFail($id);
    }

    //Fabian
    //
    public function sumatoriaFinalUnitaria($valorCuenta,$numeroNinio)
    {
    	$valorCero=1;
    	if ($numeroNinio>0) {
    		$valorCero=$numeroNinio;
    	}
    	$PorcentajeTotal=$valorCuenta/$valorCero;
    	return $PorcentajeTotal;

    }
      public function sumatoriaFinalTotal($valorCuenta,$numeroNinio,$numeroNiniosPoMes)
    {
    	$valorCero=1;
    	if ($numeroNinio>0) {
    		$valorCero=$numeroNinio;
    	}
    	$PorcentajeTotal=$valorCuenta/$valorCero;
    	$PorcentajeTotalFinal=$PorcentajeTotal*$numeroNiniosPoMes;
    	return $PorcentajeTotalFinal;

    }
}
