<?php

namespace cactu\Http\Controllers\Poas;

use Illuminate\Http\Request;
use cactu\Http\Controllers\Controller;
use cactu\Http\Requests\Poa\RqPoaActividadValorMes;
use cactu\Models\Poa\Poa;
use cactu\Models\Mes;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use cactu\Models\Poa\PoaActividadMes;
use cactu\Models\TipoActividad;
use cactu\Models\Poa\PoaActividad;

class PoaActividades extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','role_or_permission:Administrador|G. de planificaciones']);
    }
    
    
    public function index($idPoa)
    {
        $poa=Poa::findOrFail($idPoa);
        $data = array(
            'poa'=>$poa,
            'tipoActividades' => TipoActividad::all(),
            'poaActividad'=>$poa->poaActividad
        );
        return view('poas.actividades.index',$data); 
        
    }

    // A:Deivid
    // validar solo crear una poa actividad y planificacion este en proceso
    public function guardar(Request $request)
    {
        $request->validate([
            'poa' => 'required|exists:poa,id',
            'tipoActividad' => 'required|exists:tipoActividad,id',
        ]);
        $poa=Poa::findOrFail($request->poa);
        if($poa->poaActividad){
            $this->authorize('actualizarPoaActividad', $poa);
            $poaActividad=$poa->poaActividad;
            $poaActividad->tipoActividad_id=$request->tipoActividad;
            $poaActividad->save();
        }else{
            $this->authorize('crearPoaActividad', $poa);
            $poaActividad=new PoaActividad();
            $poaActividad->poa_id=$request->poa;
            $poaActividad->tipoActividad_id=$request->tipoActividad;
            $poaActividad->save();
        }
       

        $planificacion= $poaActividad->poa->planificacionModelo->planificacion;
        $desde=$planificacion->desde;
        $hasta=$planificacion->hasta;

        $periodos = CarbonPeriod::create($desde, '1 month', $hasta);
        $misMeses=[];
        foreach ($periodos as $dt) {
            $meses=Mes::get();
            $fecha =Carbon::parse($dt);
            $mes = $meses->pluck('mes')[($fecha->format('n')) - 1];
            array_push($misMeses,$mes);
        }
        $mesSync=[];
        foreach ($misMeses as $mesz) {
            $mes_m=Mes::where('mes',$mesz)->first();
            array_push($mesSync,$mes_m->id);
        }
        
        $poaActividad->meses()->sync($mesSync);
        $request->session()->flash('success','Tipo de actividad asignado');
        return redirect()->route('poaActividad',$request->poa);
    }


    public function actualizarValorMes(RqPoaActividadValorMes $request)
    {
        $poa=Poa::findOrFail($request->poa);
        $this->authorize('actualizarPoaActividad', $poa);
        
        $valorMaximoSessiones= $poa->numeroSesiones;
        $sumaValores = collect($request->valores)->sum();
        
        if($sumaValores<=$valorMaximoSessiones){
            if($request->poaActMes){
                
                foreach($request->poaActMes as $pam_id){
                    $pam=PoaActividadMes::findOrFail($pam_id);
                    $pam->valor=$request->valores[$pam_id];
                    $pam->save();
                }
            }
            $request->session()->flash('success','Valores actualizado');
            return redirect()->route('poaActividad',$request->poa);
        }else{
            $request->session()->flash('info','La suma de valores es mayor a numero de sesiones de la actividad');
            return redirect()->route('poaActividad',$request->poa)->withInput();
        }
    }
}
