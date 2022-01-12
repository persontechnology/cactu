<?php

namespace cactu\Models\Poa;

use cactu\Models\Acta;
use Illuminate\Database\Eloquent\Model;
use cactu\Models\Actividad;
use cactu\Models\CuentaContable;
use cactu\Models\Mes;
use cactu\Models\Modulo;
use cactu\Models\PlanificacionModelo;
use cactu\Models\Poa\PoaActividad;
use cactu\Models\Poa\PoaCuentas\CuentaContablePoaCuenta;
use cactu\Models\Poa\PoaCuentas\PoaContable;
use cactu\Models\Poa\PoaCuentas\PoaCuentaContableMes;
use cactu\Models\Poa\PoaParticipantes\ComunidadPoaParticipante;
use cactu\Models\Poa\PoaParticipantes\PoaParticipante;
use cactu\User;

class Poa extends Model
{
    protected $table='poa';

    public function actividad()
    {
        return $this->belongsTo(Actividad::class, 'actividad_id');
    }


    public function planificacionModelo()
    {
        return $this->belongsTo(PlanificacionModelo::class, 'planificacionModelo_id');
    }

    // A:Deivid
    // D:un poa tiene un solo poaActividad
    public function poaActividad()
    {
        return $this->hasOne(PoaActividad::class);
    }

    
    public function poaCuentaContable()
    {
        return $this->hasOne(PoaContable::class);
    }


    // A: deivid
    // D: un poa tien un modulo
    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'modulo_id');
    }

    //A:fabian lopez
    //D:es para verificar los datos de quien creo
    public function creadoPor($idUsuario)
    {
        return User::findOrFail($idUsuario);
    }
    public function actualizadoPor($idUsuario)
    {
        return User::findOrFail($idUsuario);
    }




    // A:Deivid
    // D:un poa tiene un solo poaParticipante
    public function poaParticipante()
    {
        return $this->hasOne(PoaParticipante::class);
    }



    // A:Deivid
    // D: para consultas en poas mensuales

    public function comunidadesParticipantes()
    {
        return $this->hasManyThrough(
            ComunidadPoaParticipante::class,
            PoaParticipante::class,
            'poa_id', // Foreign key on poaParticipante table...
            'poaParticipante_id', // Foreign key on comunidadPoaParticipante table...
            'id', // Local key on poa table...
            'id' // Local key on poaParticipante table...
        );
    }

    //A: Fabian lopez
    public function verificarSiExisteActa($poa,$idComunidad)
    {
        $meses = Mes::get()->pluck('mes');
        $mesActual= $meses[date('n')-1];
        
        $poas=Poa::findOrFail($poa);
        $poaContable=$poas->poaCuentaContable;
        $cuentacontable=CuentaContable::where('nombre','Materiales')->get();
        $cuentacontableCuentaPoa=CuentaContablePoaCuenta::whereIn('cuentaContable_id',$cuentacontable->pluck('id'))
        ->whereIn('poaContable_id',[$poaContable->id])->get();
        
        $mes=Mes::where('mes',$mesActual)->get();
        $cuentaContableMes=PoaCuentaContableMes::whereIn('mes_id',$mes->pluck('id'))
        ->whereIn('cuentaContablePoaCuenta_id',$cuentacontableCuentaPoa->pluck('id'))->first();
        if($cuentaContableMes){
            $acta=Acta::where('poaCuentaContableMes_id',$cuentaContableMes->id)
            ->where('comunidadPoaParticipante_id',$idComunidad)->where('estado','!=',"Planificando")->first();

            return $acta;
        }else{
            return null;
        
        }
            
        
    }
    
}
