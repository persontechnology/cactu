<?php

namespace cactu\Http\Controllers\Localidad;

use Illuminate\Http\Request;
use cactu\Http\Controllers\Controller;
use cactu\DataTables\Localidad\ProvinciaDataTable;
use cactu\Models\Localidad\Provincia;
use Illuminate\Support\Facades\DB;
class Provincias extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role_or_permission:Administrador|G. de comunidades']);
    }

    public function index(ProvinciaDataTable $dataTable)
    {
        return $dataTable->render('localidad.provincias.index');
    }

    public function nuevo()
    {
        return view('localidad.provincias.nuevo');
    }
    public function guardar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:provincia,nombre|max:191',
            'codigo'=>'required|unique:provincia,codigo|max:191',
        ]);
        Provincia::create(['nombre' => $request->nombre,'codigo'=>$request->codigo]);
        $request->session()->flash('success','Provincia ingresado');
        return redirect()->route('provincias');
    }

    public function editar($idProvincia)
    {
        $provincia=Provincia::findOrFail($idProvincia);
        return view('localidad.provincias.editar',['provincia'=>$provincia]);
    }

    public function actualizar(Request $request)
    {
        $request->validate([
            'provincia'=>'required|exists:provincia,id',
            'nombre' => 'required|max:191|unique:provincia,nombre,'.$request->provincia,
            'codigo'=>'required|max:191|unique:provincia,codigo,'.$request->provincia,
        ]);

        $provincia=Provincia::findOrFail($request->provincia);
        $provincia->nombre = $request->nombre;
        $provincia->codigo=$request->codigo;
        $provincia->save();
        $request->session()->flash('success','Provincia actualizado');
        return redirect()->route('provincias');
    }

    public function eliminar(Request $request)
    {
        $request->validate([
            'provincia'=>'required|exists:provincia,id',
        ]);

        try {
            DB::beginTransaction();
            $provincia=Provincia::findOrFail($request->provincia);
            $provincia->delete();
            DB::commit();
            return response()->json(['success'=>'Provincia eliminado']);

        } catch (\Exception $th) {
            DB::rollBack();
            return response()->json(['default'=>'No se puede eliminar provincia']);
        }
    }
}
