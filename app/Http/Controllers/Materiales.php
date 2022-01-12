<?php

namespace cactu\Http\Controllers;

use cactu\DataTables\MaterialesDataTable;
use cactu\Imports\MaterialesImport;
use cactu\Models\Material;
use cactu\Models\Poa\PoaCuentas\PoaCuentaContableMes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class Materiales extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role_or_permission:Administrador|G. de materiales']);
    }
    public function index(MaterialesDataTable $dataTable)
    {
        return  $dataTable->render('materiales.index');
    }
    public function guardar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:materials|max:255',
            'precio' => 'required|numeric',
            'iva' => 'required|numeric',
        ]);
    	$material= new Material();
        $material->nombre=$request->nombre;
        $material->precio=$request->precio;
        $material->iva=$request->iva;
    	$material->creadoPor=Auth::id();
    	$material->save();
    	$request->session()->flash('success','Nuevo material creada');
        return redirect()->route('materiales');
    }
    public function nuevo()
    {
        return view('materiales.nuevo');
    }

    public function editar($idmaterial)
    {
        $material=Material::findOrFail($idmaterial);        
    	$data = array('material' =>$material);
	    return view('materiales.editar',$data);
    	
    }
    public function actualizar(Request $request)
    {
        $request->validate([
            'nombre'=>'required|string|max:191|unique:materials,nombre,'.$request->material,
            'precio' => 'required|numeric',
            'iva' => 'required|numeric',
        ]);
        $material=Material::findOrFail($request->material);        
    	$material->nombre=$request->nombre;
        $material->precio=$request->precio;
        $material->iva=$request->iva;
    	$material->actualizadoPor=Auth::id();
    	$material->save();
    	$request->session()->flash('success','Material actualizado');
        return redirect()->route('materiales');
    }
    public function eliminar(Request $request)
    {
        $request->validate([
            'material'=>'required|exists:materials,id',
        ]);
        
        try {
            DB::beginTransaction();
            $material=Material::findOrFail($request->material);
                 
	        $material->delete();
	        DB::commit();
            return response()->json(['success'=>'Material eliminado']);        

        } catch (\Exception $th) {
            DB::rollBack();
            return response()->json(['default'=>'No se puede eliminar el material']);
        }
    }
    public function guardarPost(Request $request)
    {
       
            
            $request->validate([
                'nombre' => 'required|unique:materials|max:255',
                'precio' => 'required|numeric',
                'iva' => 'required|numeric',
            ]);
            $material= new Material();
            $material->nombre=$request->nombre;
            $material->precio=$request->precio;
            $material->iva=$request->iva;
            $material->creadoPor=Auth::id();
            $material->save();
            $request->session()->flash('success','Material ingresado exitosamente');
            return redirect()->route('acta-material',$request->mes);
        
    }
    public function importarMaterial()
    {
        return view('materiales.importar');
    }
    public function importarArchivo(Request $request)
    {
        $this->validate($request,[
            'archivo'=>'required|'
        ]);
        try {    	
            Excel::import(new MaterialesImport, request()->file('archivo'));
        } catch (\Exception $ex) {
        return back()->with('error', 'Los materiales no pueden ser registrados verifique el excel');            
    }
        $request->session()->flash('success','materiales creado exisosamente');
        return redirect()->route('materiales');
    }

}
