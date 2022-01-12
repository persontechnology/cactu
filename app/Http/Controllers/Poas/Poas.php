<?php

namespace cactu\Http\Controllers\Poas;

use Illuminate\Http\Request;
use cactu\Http\Controllers\Controller;
use cactu\Http\Requests\Poa\RqNuevaActividad;
use cactu\Models\PlanificacionModelo;
use cactu\Models\Poa\Poa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use cactu\Models\Poa\PoaParticipantes\ComunidadPoaParticipante;

class Poas extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','role_or_permission:Administrador|G. de planificaciones']);
    }
    
    // A:Deivid
    /*D:armar el poa de cada modulo referente a la planificacion
    Ingresar
    */
    public function index($IdPlanificacionModelo)
    {
        $planificacionModelo=PlanificacionModelo::findOrFail($IdPlanificacionModelo);
        $data = array(
            'planificacionModelo'=>$planificacionModelo,
            'poas'=>$planificacionModelo->poas
        );
        return view('poas.index',$data);
    }

    public function nuevo($IdPlanificacionModelo)
    {
        $planificacionModelo=PlanificacionModelo::findOrFail($IdPlanificacionModelo);
        $actividadesSi=$planificacionModelo->poas??null;
        $actividadesNo=$planificacionModelo->modeloProgramatico->actividades()->whereNotIn('id',$actividadesSi->pluck('actividad_id'))->get();
   
        $data = array(
            'planificacionModelo'=>$planificacionModelo,
            'actividades' =>  $actividadesNo,
            'modulos'=>$planificacionModelo->modeloProgramatico->modulos,
        );

        return view('poas.nuevo',$data);
    }

    public function guardar(RqNuevaActividad $request)
    {
        $planificacionModelo=PlanificacionModelo::findOrFail($request->planificacionModelo);
        $this->authorize('crearPoa', $planificacionModelo);
        $poa=new Poa();
        $poa->planificacionModelo_id=$request->planificacionModelo;
        $poa->actividad_id=$request->actividad;
        $poa->modulo_id=$request->modulo;
        $poa->numeroSesiones=$request->numeroSesion;
        $poa->descripcion=$request->descripcion;
        $poa->creadoPor=Auth::id();
        $poa->save();
        $request->session()->flash('success','Nuevo actividad ingresado');
        return redirect()->route('armarPoa',$request->planificacionModelo);
    }

    public function actualizarPoaItem(Request $request)
    {
        
        
        $request->validate([
            'poa'=>'required|exists:poa,id',
            'actividad' => 'required|exists:actividad,id',
            'modulo'=>'required|exists:modulo,id',
            'numeroSesion'=>'required|integer|min:0',
            'descripcion'=>'required|max:255'
        ]);

        $poa=Poa::findOrFail($request->poa);
        $this->authorize('crearPoa', $poa->planificacionModelo);
        
        $poa->actividad_id=$request->actividad;
        $poa->modulo_id=$request->modulo;
        $poa->numeroSesiones=$request->numeroSesion;
        $poa->descripcion=$request->descripcion;
        $poa->actualizadoPor=Auth::id();
        $poa->save();
        $request->session()->flash('success','Actividad actualizado exitosamente');
        return redirect()->route('armarPoa',$poa->planificacionModelo);
    }
     public function eliminarPoa(Request $request)
    {
        $request->validate([
            'idPoa'=>'required|exists:poa,id',
        ]);
        try {
            DB::beginTransaction();
            $poa=Poa::findOrFail($request->idPoa);
           $this->authorize('eliminar', $poa->planificacionModelo->planificacion);
            $poa->delete();
            DB::commit();
            $request->session()->flash('success','La actividad fue eliminada');
            return response()->json(['success'=>'La actividad fue eliminada']);

        } catch (\Exception $th) {
            DB::rollBack();
            $request->session()->flash('default','No se puede eliminar la actividad ya tiene relación con otra parte del sistema');
            return response()->json(['default'=>'No se puede eliminar la actividad ya tiene relación con otra parte del sistema']);
        }
    
    }
    public function reportesVista($idComunidadPoaParticipante)
    {
        $comunidadPoaParticipante=ComunidadPoaParticipante::findOrFail($idComunidadPoaParticipante);
        return view('poas.reporte',["comunidad"=>$comunidadPoaParticipante]);
    }


    public function editarPoa($idPoa)
    {

        $poa=Poa::findOrFail($idPoa);
        $actividadesSi=$poa->planificacionModelo->poas??null;
        $actividadesNo=$poa->planificacionModelo->modeloProgramatico->actividades()->get();
   
        $data = array(
            'planificacionModelo'=>$poa->planificacionModelo,
            'actividades' =>  $actividadesNo,
            'modulos'=>$poa->planificacionModelo->modeloProgramatico->modulos,
            'poa'=>$poa
        );
        return view('poas.editar',$data);
    }
}
