<?php

namespace cactu\Http\Controllers\Poas;

use Illuminate\Http\Request;
use cactu\Http\Controllers\Controller;
use cactu\Http\Requests\Poa\RqPoaCuentaContableValorMes;
use cactu\Models\Poa\Poa;
use cactu\Models\Mes;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use cactu\Models\CuentaContable;
use cactu\Models\Poa\PoaCuentas\PoaContable;
use cactu\Models\Poa\PoaCuentas\PoaCuentaContableMes;
use cactu\Models\Poa\PoaCuentas\CuentaContablePoaCuenta;
use Illuminate\Support\Facades\DB;
class PoaCuentasContables extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['auth','role_or_permission:Administrador|G. de planificaciones']);
    }
    
    public function index($idPoa)
    {
        $poa=Poa::findOrFail($idPoa);
         $poaCuentaContable=$poa->poaCuentaContable;
        if(!$poaCuentaContable){
            $poaCuentaContable=new PoaContable();
            $poaCuentaContable->poa_id=$poa->id;
            $poaCuentaContable->save();
        }
        
        $cuentasSi=$poaCuentaContable->cuentasContables??null;
        $cuentasNo=CuentaContable::whereNotIn('id',$cuentasSi->pluck('id'))->get();
        $data = array(
            'poa'=>$poa,
            'cuentasSi' => $cuentasSi,
            'cuentasNo' => $cuentasNo,
        );
        return view('poas.cuentas.index',$data); 
        
    }

    // A:fabian
    // validar solo crear una poa actividad y planificacion este en proceso

    public function actualizarMeses($idCuentaContablePoaCuenta)
    {

        $cunetacontableuno=CuentaContablePoaCuenta::findOrFail($idCuentaContablePoaCuenta);
         $planificacion= $cunetacontableuno->poaContable->poa->planificacionModelo->planificacion;
        $desde=$planificacion->desde;
        $hasta=$planificacion->hasta;

        $period = CarbonPeriod::create($desde, '1 month', $hasta);
        $misMeses=[];
        foreach ($period as $dt) {
            $poaMeses=Mes::get();
            $fecha =Carbon::parse($dt);
            $mes = $poaMeses->pluck('mes')[($fecha->format('n')) - 1];
            array_push($misMeses,$mes);
        }
        $mesSync=[];
        foreach ($misMeses as $mesz) {
            $mes_m=Mes::where('mes',$mesz)->first();
            array_push($mesSync,$mes_m->id);
        }
        
        $cunetacontableuno->meses()->sync($mesSync);

    }
     public function actualizar(Request $request)
    {
        $request->validate([
            'poa' => 'required|exists:poa,id',
            'descripcion' => 'required|max:255',
        ]);
        $poa=Poa::findOrFail($request->poa);
        $poa->poaCuentaContable->descripcion=$request->descripcion;
        $poa->poaCuentaContable->save();
        $request->session()->flash('success','Descripción de Poa Cuenta Contable actualizada');
        return redirect()->route('poaCuentaContable',$poa->id);
    }
    public function actualizarCuentasContables(Request $request)
    {
        
        $request->validate([
            'poa' => 'required|exists:poa,id',
            "cunetasContables"    => "nullable|array",
            "cunetasContables.*"  => "nullable|exists:cuentaContable,id",
        ]);
        $poa=Poa::findOrFail($request->poa);
        $mensajeerror="";
        try {
        $poa->poaCuentaContable->cuentasContables()->sync($request->cunetasContables);
        //for para sincronizar las cuentas contable con varios meses
            foreach ($poa->poaCuentaContable->cuentasContables as $cuenta) {         
                $this->actualizarMeses($cuenta->cuentaContablePoaCuenta->id);         
             }
         } catch (\Exception $e) {
             $mensajeerror="noSePuede";
         }     
        if($mensajeerror=="noSePuede"){
            $request->session()->flash('tabsCuenta','meses-tab');
            $request->session()->flash('info','No se puede eliminar ya posee meses asignados a esta cuenta contable');
        }else{
            $request->session()->flash('tabsCuenta','cuentaContable-tab');
            $request->session()->flash('success','Cuentas contables del Poa Cuentas actualizado');
        }
        return redirect()->route('poaCuentaContable',$poa->id);
    }

    
     public function actualizarValorMes(RqPoaCuentaContableValorMes $request)
    {
        $cuentaContable=CuentaContablePoaCuenta::findOrFail($request->cuentaContable);
        if($request->poaContMes){
            
            foreach ($request->poaContMes as $pcm) {
                $pocuemes=PoaCuentaContableMes::findOrFail($pcm);
                $pocuemes->valor=$request->valores[$pcm];
                $pocuemes->save();
            }

        }
        $request->session()->flash('tabsCuenta','meses-tab');
        $request->session()->flash('collapsible-item-group_'.$request->cuentaContable);        
        $request->session()->flash('success','Valores actualizado');
        return redirect()->route('poaCuentaContable',$cuentaContable->poaContable->poa->id);
       
    }
    public function eliminarMeses(Request $request)
    {
        $request->validate([
            "cuentaContable"=>'required|exists:cuentaContablePoaCuenta,id'
        ]);         
        
        try {
            DB::beginTransaction();
            $cuentaContable=CuentaContablePoaCuenta::findOrFail($request->cuentaContable);
            foreach ($cuentaContable->mesesCuenta as $meses) {
               $PoaCuentaContableMes=PoaCuentaContableMes::findOrFail($meses->id);
                $PoaCuentaContableMes->delete();
            }

            $cuentaContable->delete();
            DB::commit();
            $request->session()->flash('tabsCuenta','meses-tab');
            $request->session()->flash('success','Cuenta contable eliminada');
        } catch (\Exception $th) {
            DB::rollBack();
             $request->session()->flash('tabsCuenta','meses-tab');
            $request->session()->flash('danger','No se puede eliminar la cuenta contable');
        }
        
    }
}
