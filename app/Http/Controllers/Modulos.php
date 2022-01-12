<?php

namespace cactu\Http\Controllers;

use Illuminate\Http\Request;
use cactu\Models\ModeloProgramatico;
use cactu\Models\Modulo;
use Illuminate\Support\Facades\Auth;
use cactu\DataTables\ModuloDataTable;
use cactu\Http\Requests\Modulos\RqCrear;
use cactu\Http\Requests\Modulos\RqEditar;
use Illuminate\Support\Facades\DB;
class Modulos extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(ModuloDataTable  $dataTable,$idModeloProgramatico)
    {
        $modelo=ModeloProgramatico::findOrFail($idModeloProgramatico);
        $data = array('modelo' =>$modelo);
        return  $dataTable->with('idModeloProgramatico',$modelo->id)->render('modulos.index',$data);
    }
    public function nuevo($idModeloProgramatico)
    {
        $modelo=ModeloProgramatico::findOrFail($idModeloProgramatico);
        $modulos=$modelo->modulos;
        $data = array('modelo' =>$modelo,'modulo'=>$modulos);
        return view('modulos.nuevo',$data);
    }
     public function guardar(RqCrear $request)
    {
        $modelo=ModeloProgramatico::findOrFail($request->modelo);
        $modulo= new Modulo;
        $modulo->modeloProgramatico_id=$modelo->id;
        $modulo->nombre=$request->nombre;
        $modulo->codigo=strtoupper($request->codigo);
        $modulo->usuarioCreado=Auth::id();
        $modulo->save();
        $request->session()->flash('success','Nuevo módulo creado');
        return redirect()->route('modulos',$modelo->id);
    }
     public function editar($idModulo)
    {
        $modulos=Modulo::findOrFail($idModulo);        
        $data = array('modulo'=>$modulos);
        return view('modulos.editar',$data);
    }
        public function actualizar(RqEditar $request)
    {
        $modulo=Modulo::findOrFail($request->modulo);
        $modulo->nombre=$request->nombre;
        $modulo->codigo=strtoupper($request->codigo);
        $modulo->usuarioActualizado=Auth::id();
        $modulo->save();
        $request->session()->flash('success','Módulo actualizada');
        return redirect()->route('modulos',$modulo->modeloProgramatico_id);
    }
    public function eliminar(Request $request)
    {
        $request->validate([
            'modulo'=>'required|exists:modulo,id',
        ]);

        try {
            DB::beginTransaction();
            $modulo=Modulo::findOrFail($request->modulo);
            $modulo->delete();
            DB::commit();
            return response()->json(['success'=>'Módulo eliminado']);

        } catch (\Exception $th) {
            DB::rollBack();
            return response()->json(['default'=>'No se puede eliminar el módulo']);
        }
    }
}
