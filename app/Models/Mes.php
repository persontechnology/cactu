<?php

namespace cactu\Models;

use cactu\Models\Poa\PoaCuentas\PoaCuentaContableMes;
use Illuminate\Database\Eloquent\Model;

class Mes extends Model
{
    protected $table='mes';
    protected $fillable = [
        'mes'
    ];


    // a: deivid
    // D: buscar poa cuenta contable por mes
    public function poaCuentaContableMesPorId($id)
    {
        return PoaCuentaContableMes::findOrFail($id);
    }
}
