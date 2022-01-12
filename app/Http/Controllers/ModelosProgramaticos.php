<?php

namespace cactu\Http\Controllers;

use Illuminate\Http\Request;
use cactu\Models\ModeloProgramatico;
use cactu\DataTables\ModeloProgramaticoDataTable;
use Illuminate\Support\Facades\Auth;
use cactu\Http\Requests\ModelosProgramaticos\RqCrear;
use cactu\Http\Requests\ModelosProgramaticos\RqEditar;
use Illuminate\Support\Facades\DB;
use cactu\Imports\ModelosProgramaticosImport;
use cactu\Imports\ActividadesImport;
use cactu\Imports\ModuloImport;


use Maatwebsite\Excel\Facades\Excel;
class ModelosProgramaticos extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth','role_or_permission:Administrador|G. de modelo programáticos']);
    }
    /*Autor:Fabian Lopez
    Descripcion:En esta funcion se muestra los datos de los modelos programaticos*/
    public function index(ModeloProgramaticoDataTable $dataTable)
    {
    	return  $dataTable->render('modelosProgramaticos.index');
    }
    public function nuevo()
    {
    	return view('modelosProgramaticos.nuevo');
    }
    public function guardar(RqCrear $request)
    {
    	$modelo= new ModeloProgramatico;
    	$modelo->nombre=$request->nombre;
    	$modelo->codigo=strtoupper($request->codigo);
    	$modelo->usuarioCreado=Auth::id();
    	$modelo->save();
    	$request->session()->flash('success','Nuevo modelo pragramático creado');
        return redirect()->route('modelos');
    }
    public function editar($idModeloProgramatico)
    {
    	$modelo=ModeloProgramatico::findOrFail($idModeloProgramatico);
    	$data = array('modelo' =>$modelo);
    	return view('modelosProgramaticos.editar',$data);
    }
    public function actualizar(RqEditar $request)
    {
    	$modelo=ModeloProgramatico::findOrFail($request->modelo);
    	$modelo->nombre=$request->nombre;
    	$modelo->codigo=strtoupper($request->codigo);
    	$modelo->usuarioActualizado=Auth::id();
    	$modelo->save();
    	$request->session()->flash('success','Modelo pragramático actualizado');
        return redirect()->route('modelos');
    }
    public function eliminar(Request $request)
    {
        $request->validate([
            'modelo'=>'required|exists:modeloProgramatico,id',
        ]);

        try {
            DB::beginTransaction();
            $modelo=ModeloProgramatico::findOrFail($request->modelo);
            $modelo->delete();
            DB::commit();
            return response()->json(['success'=>'Modelo Programático eliminado']);

        } catch (\Exception $th) {
            DB::rollBack();
            return response()->json(['default'=>'No se puede eliminar el modelo programático']);
        }
    }

    public function importarModelo()
    {
        return view('modelosProgramaticos.importarModelo');
    }
    
    public function procesarImportacionModelo(Request $request)
    {
        $request->validate([
            'archivo'=>'required|mimes:xls,xlsx'
        ]);
        Excel::import(new ModelosProgramaticosImport, $request->file('archivo'));
        return redirect()->route('modelos')->with('success', 'Modelos Programaticos importados');
        
    }

    public function importarActividad()
    {
      
        return view('modelosProgramaticos.importarActividades');
    }
    
    public function procesarImportacionActividad(Request $request)
    {
        $request->validate([
            'archivo'=>'required'
        ]);
        Excel::import(new ActividadesImport, $request->file('archivo'));
        return redirect()->route('modelos')->with('success', 'Actividades importadas');
        
    }
    public function importarModulo()
    {
      
        return view('modelosProgramaticos.importarModulo');
    }
    
    public function procesarImportacionModulo(Request $request)
    {
        $request->validate([
            'archivo'=>'required'
        ]);
        Excel::import(new ModuloImport, $request->file('archivo'));
        return redirect()->route('modelos')->with('success', 'Modulos importados');
        
    }
}
