<?php

namespace cactu\Http\Controllers;

use Illuminate\Http\Request;
use cactu\DataTables\PlanificacionDataTable;
use cactu\Models\Planificacion;
use cactu\Http\Requests\Planificaciones\RqCrear;
use cactu\Http\Requests\Planificaciones\RqEditar;

use Illuminate\Support\Facades\Auth;
use cactu\Models\PlanificacionModelo;
use cactu\Models\ModeloProgramatico;

use Illuminate\Support\Facades\DB;
class Planificaciones extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth','role_or_permission:Administrador|G. de planificaciones']);
	}
	
    public function index(PlanificacionDataTable $dataTable)
    {
        return  $dataTable->render('planificaciones.index');
    }
    public function nueva()
    {
    	return view('planificaciones.nueva');
    }
    public function guardar(RqCrear $request)
    {
        $this->authorize('crear', Planificacion::class);
        
    	$planificacion=new Planificacion();
    	$planificacion->nombre=$request->nombre;
    	$planificacion->desde=$request->desde;
    	$planificacion->hasta=$request->hasta;
    	$planificacion->creadoPor=Auth::id();
    	$planificacion->save();
    	session()->flash('succes','Planificación creada exitosamente');
      	return redirect()->route('planificaciones');
    }
    public function editar($idPlanificacion)
    {
		$planificacion=Planificacion::findOrFail($idPlanificacion);
		$this->authorize('actualizar', $planificacion);
    	return view('planificaciones.editar',['planificacion'=>$planificacion]);
    	
    }
    public function actualizar(RqEditar $request)
    {
    	$planificacion=Planificacion::findOrFail($request->planificacion);
		$this->authorize('actualizar', $planificacion);
		$planificacion->nombre=$request->nombre;
		$planificacion->desde=$request->desde;
		$planificacion->hasta=$request->hasta;
        $planificacion->actualizadoPor=Auth::id();
        $planificacion->estado=$request->estado;
		$planificacion->save();
		session()->flash('success','Planificación editada exitosamente');
		return redirect()->route('planificaciones');
    }

    public function eliminarPlanificacion(Request $request)
    {
        $request->validate([
            'idPlanificacion'=>'required|exists:planificacion,id',
        ]);
        try {
            DB::beginTransaction();
            $planificacion=Planificacion::findOrFail($request->idPlanificacion);
           $this->authorize('eliminar', $planificacion);
            $planificacion->delete();
            DB::commit();
            return response()->json(['success'=>'La planificación fue eliminada']);    

        } catch (\Exception $th) {
            DB::rollBack();
            return response()->json(['default'=>'No se puede eliminar la planificacion ya tiene relación con otra parte del sistema']);
        }
    
    }
    
    
    public function modeloProgramatico($idPlanificacion)
    {
    	$planificacion=Planificacion::findOrFail($idPlanificacion);   
        
        $mpSinAsignar=ModeloProgramatico::whereNotIn('id',$planificacion->planificacionModelos()->pluck('modeloProgramatico_id'))->get();    	
        
    	return view('planificaciones.indexPlanificacionModelo',['planificacion'=>$planificacion,'mpSinAsignar'=>$mpSinAsignar]);
    }


    public function asignarModeloProgramatico(Request $request)
    {
    	$request->validate([
            'planificacion' => 'required|exists:planificacion,id',
            'modeloProgramatico' => 'required|exists:modeloProgramatico,id',           
        ]);
        $planificacion=Planificacion::findOrFail($request->planificacion);
        $this->authorize('creaPlanificacionModelo', $planificacion);
    	$planificacionModelo=new PlanificacionModelo();
    	$planificacionModelo->planificacion_id=$request->planificacion;
    	$planificacionModelo->modeloProgramatico_id=$request->modeloProgramatico;
    	$planificacionModelo->creadoPor=Auth::id();
    	$planificacionModelo->save();
    	$request->session()->flash('success','El modelo programático fue asignado exitosamente a la planificación');
      	return redirect()->route('planificaciones-modelo',$request->planificacion);	

    }
    public function eliminnarModeloProgramatico(Request $request)
    {
    	$request->validate([
            'idPlanificacionModelo'=>'required|exists:planificacionModelo,id',
        ]);
        try {
            DB::beginTransaction();
            $planificacionModelo=PlanificacionModelo::findOrFail($request->idPlanificacionModelo);
            $this->authorize('eliminar', $planificacionModelo);
	        $planificacionModelo->delete();
	        DB::commit();
            return response()->json(['success'=>'La asignación del modelo programático fue eliminada']);    

        } catch (\Exception $th) {
            DB::rollBack();
            return response()->json(['default'=>'No se puede eliminar el modelo programático ya tiene relación con otra parte del sistema']);
        }
    }
  
}
