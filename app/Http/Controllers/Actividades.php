<?php

namespace cactu\Http\Controllers;

use Illuminate\Http\Request;
use cactu\Models\ModeloProgramatico;
use cactu\Models\Actividad;
use Illuminate\Support\Facades\Auth;
use cactu\DataTables\ActividadDataTable;
use cactu\Http\Requests\Actividades\RqCrear;
use cactu\Http\Requests\Actividades\RqEditar;
use Illuminate\Support\Facades\DB;
class Actividades extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(ActividadDataTable  $dataTable,$idModeloProgramatico)
    {
        $modelo=ModeloProgramatico::findOrFail($idModeloProgramatico);
        $data = array('modelo' =>$modelo);
        return  $dataTable->with('idModeloProgramatico',$modelo->id)->render('actividades.index',$data);
    }
    public function nuevo($idModeloProgramatico)
    {
        $modelo=ModeloProgramatico::findOrFail($idModeloProgramatico);
        $actividades=$modelo->actividades;
        $data = array('modelo' =>$modelo,'actividad'=>$actividades);
        return view('actividades.nuevo',$data);
    }
     public function guardar(RqCrear $request)
    {
        $modelo=ModeloProgramatico::findOrFail($request->modelo);
        $actividad= new Actividad;
        $actividad->modeloProgramatico_id=$modelo->id;
        $actividad->nombre=$request->nombre;
        $actividad->codigo=$request->codigo;
        $actividad->usuarioCreado=Auth::id();
        $actividad->save();
        $request->session()->flash('success','Nueva actividad creada');
        return redirect()->route('actividades',$modelo->id);
    }
     public function editar($idActividad)
    {
        $actividades=Actividad::findOrFail($idActividad);        
        $data = array('actividad'=>$actividades);
        return view('actividades.editar',$data);
    }
        public function actualizar(RqEditar $request)
    {
        $actividad=Actividad::findOrFail($request->actividad);
        $actividad->nombre=$request->nombre;
        $actividad->codigo=$request->codigo;
        $actividad->usuarioActualizado=Auth::id();
        $actividad->save();
        $request->session()->flash('success','Actividad actualizada');
        return redirect()->route('actividades',$actividad->modeloProgramatico_id);
    }
    public function eliminar(Request $request)
    {
        $request->validate([
            'actividad'=>'required|exists:actividad,id',
        ]);

        try {
            DB::beginTransaction();
            $actividad=Actividad::findOrFail($request->actividad);
            $actividad->delete();
            DB::commit();
            return response()->json(['success'=>'Actividad eliminada']);

        } catch (\Exception $th) {
            DB::rollBack();
            return response()->json(['default'=>'No se puede eliminar actividad']);
        }
    }
}
