<?php

namespace cactu\Models\Poa\PoaParticipantes;

use cactu\Models\Localidad\Comunidad;
use cactu\Models\Poa\Poa;
use cactu\Models\TipoParticipante;
use Illuminate\Database\Eloquent\Model;
use cactu\Models\Mes;
use cactu\Models\Poa\PoaParticipantes\ComunidadPoaParticipante;
use cactu\Models\Poa\PoaParticipantes\PoaParticipanteMes;
use Illuminate\Support\Facades\DB;
use cactu\Models\Registro\Asistencia;

class PoaParticipante extends Model
{
    protected $table='poaParticipante';
    
    public function tipoParticipantes()
    {
        return $this->belongsToMany(TipoParticipante::class, 'poaParticipanteTipoParticipante', 'poaParticipante_id', 'tipoParticipante_id')
        ->as('poaParticipanteTipoParticipante')
        ->withPivot(['id']);
    }


    public function comunidades()
    {
        return $this->belongsToMany(Comunidad::class, 'comunidadPoaParticipante', 'poaParticipante_id', 'comunidad_id')
        ->as('comunidadPoaParticipante')
        ->withPivot(['id','gestor_id','coordinador_id']);
    }

    // A:Deivid
    // D:de poaParticipante a tabla media poaParticipantedMes a tabla final mes
    public function meses()
    {
        return $this->belongsToMany(Mes::class, 'poaParticipanteMes', 'poaParticipante_id', 'mes_id')
        ->as('poaParticipanteMes')
        ->withPivot(['id','valor']);
    }

    public function poa()
    {
        return $this->belongsTo(Poa::class, 'poa_id');
    } 

    public function comunidadPoaParticipantes()
    {
        return $this->hasMany(ComunidadPoaParticipante::class,'poaParticipante_id');
    }

    public function poaParticipanteMeses()
    {
        return $this->hasMany(PoaParticipanteMes::class,'poaParticipante_id');
    }
    //A:Fabian
    //metodo para verificar el total de las asistencias de cada mes
    public function resultadoParticipantes($idPoaPar,$idPoMes)
    {
        $result=PoaParticipante::
                join('comunidadPoaParticipante','comunidadPoaParticipante.poaParticipante_id','=', 'poaParticipante.id')
                ->join('asistencias','asistencias.comunidadPoaParticipante_id','=', 'comunidadPoaParticipante.id')
                ->join('listados','listados.asistencia_id','=', 'asistencias.id')            
                ->where('poaParticipante.id',$idPoaPar) 
                ->whereMonth('asistencias.fecha','=',$this->valorMeses($idPoMes))  
                ->groupBy('poaParticipante.id')                  
                ->count();
        return $result;
        
    }
        //A:Fabian
    //metodo para verificar el total de las asistencias de cada mes por cuenta contable
    public function resultadoParticipantesCuenta($idPoaPar,$idPoMes,$cuentaContable)
    {
        $result=PoaParticipante::
                join('comunidadPoaParticipante','comunidadPoaParticipante.poaParticipante_id','=', 'poaParticipante.id')
                ->join('asistencias','asistencias.comunidadPoaParticipante_id','=', 'comunidadPoaParticipante.id')
                ->join('listados','listados.asistencia_id','=', 'asistencias.id')
                ->join('listaCuentaContable','listaCuentaContable.listado_id','=', 'listados.id')              
                ->where('listaCuentaContable.cuentaContablePoaCuenta_id',$cuentaContable)  
                ->where('poaParticipante.id',$idPoaPar)
                ->whereMonth('asistencias.fecha','=',$this->valorMeses($idPoMes))  
                ->groupBy('poaParticipante.id')                  
                ->count();
        return $result;
        
    }

    //A:Fabian
    //metodo para extaer el valor de cada mes para realizar los calculos 
    public function valorParticiPoaMes($poaParticipante , $valormes)
    {
        $mes=Mes::where('mes',$valormes)->firstOrFail();
        $poaParticipanteMes=PoaParticipanteMes::where('poaParticipante_id',$poaParticipante)
        ->where('mes_id',$mes->id)->firstOrFail();
        return  $poaParticipanteMes->valor;
    }

    public function valorMeses($mes)
    {
        $mes1="";
        switch ($mes) {
            case 'Enero':
                $mes1=1;
                break;
                case 'Febrero':
                $mes1=2;
                break;
                case 'Marzo':
                $mes1=3;
                break;
                case 'Abril':
                $mes1=4;
                break;
                case 'Mayo':
                $mes1=5;
                break;
                case 'Junio':
                $mes1=6;
                break;
                case 'Julio':
                $mes1=7;
                break;
                case 'Agosto':
                $mes1=8;
                break;
                case 'Septiembre':
                $mes1=9;
                break;
                case 'Octubre':
                $mes1=10;
                break;
                case 'Noviembre':
                $mes1=11;
                break;
                case 'Diciembre':
                $mes1=12;
                break;
            
        }
        return $mes1;
    }

}
