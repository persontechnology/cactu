<?php

namespace cactu\Http\Controllers\Localidad;

use Illuminate\Http\Request;
use cactu\Http\Controllers\Controller;
use cactu\DataTables\Localidad\CantonesEnProvinciaDataTable;
use cactu\Models\Localidad\Provincia;
use cactu\Models\Localidad\Canton;
use Illuminate\Support\Facades\DB;
use cactu\Http\Requests\Localidad\Canton\RqActualizar;
use cactu\Http\Requests\Localidad\Canton\RqGuardar;
use cactu\DataTables\Localidad\CantonDataTable;

class Cantones extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role_or_permission:Administrador|G. de comunidades']);
    }


    public function index(CantonDataTable $dataTable)
    {
        return $dataTable->render('localidad.cantones.index');
    }

    public function nuevo()
    {
        $provincias=Provincia::all();
        return view('localidad.cantones.nuevo',['provincias'=>$provincias]);
    }
    public function guardar(RqGuardar $request)
    {
        Canton::create(['nombre' => $request->nombre,'codigo'=>$request->codigo,'provincia_id'=>$request->provincia]);
        $request->session()->flash('success','Cantón ingresado');
        return redirect()->route('cantones');
    }

    public function editar($idCanton)
    {
        $provincia=Provincia::all();
        $canton=Canton::findOrFail($idCanton);
        return view('localidad.cantones.editar',['canton'=>$canton,'provincias'=>$provincia]);
    }

    public function actualizar(RqActualizar $request)
    {
        $canton=Canton::findOrFail($request->canton);
        $canton->nombre=$request->nombre;
        $canton->codigo=$request->codigo;
        $canton->save();
        $request->session()->flash('success','Cantón actualizado');
        return redirect()->route('cantones');
    }

    // en cantones

    public function cantonesEnProvincia(CantonesEnProvinciaDataTable $dataTable, $idProvincia)
    {
        $provincia=Provincia::findOrFail($idProvincia);
        return $dataTable->with('provincia',$provincia)->render('localidad.cantones.cantonesEnProvincia',['provincia'=>$provincia]);
    }



    public function eliminar(Request $request)
    {
        $request->validate([
            'canton'=>'required|exists:canton,id',
        ]);

        try {
            DB::beginTransaction();
            $canton=Canton::findOrFail($request->canton);
            $canton->delete();
            DB::commit();
            return response()->json(['success'=>'Cantón eliminado']);

        } catch (\Exception $th) {
            DB::rollBack();
            return response()->json(['default'=>'No se puede eliminar cantón']);
        }
    }


    public function editarCantonEnProvincia($idCanton)
    {
        $provincias=Provincia::all();
        $canton=Canton::findOrFail($idCanton);
        return view('localidad.cantones.editarCantonEnProvincia',['canton'=>$canton,'provincias'=>$provincias]);
    }
    public function actualizarCantonEnProvincia(RqActualizar $request)
    {
        $canton=Canton::findOrFail($request->canton);
        $canton->nombre=$request->nombre;
        $canton->codigo=$request->codigo;
        $request->session()->flash('success','Cantón actualizado');
        $canton->save();
        return redirect()->route('cantonesEnProvincia',$canton->provincia->id);
    }
}
