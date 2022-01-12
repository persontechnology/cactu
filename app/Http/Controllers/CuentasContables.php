<?php

namespace cactu\Http\Controllers;

use Illuminate\Http\Request;
use cactu\Models\CuentaContable;
use cactu\DataTables\CuentaContableDataTable;
use Illuminate\Support\Facades\Auth;
use cactu\Http\Requests\CuentaContables\RqCrear;
use cactu\Http\Requests\CuentaContables\RqEditar;
use Illuminate\Support\Facades\DB;

class CuentasContables extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role_or_permission:Administrador|G. de cuentas contables']);
    }
    /*Autor:Fabian Lopez
    Descripcion:En esta funcion se muestra los datos de las cuentas contables*/
    public function index(CuentaContableDataTable $dataTable)
    {
    	return  $dataTable->render('cuentasContables.index');
    }
    public function guardar(RqCrear $request)
    {
    	$cuentaContable= new CuentaContable;
    	$cuentaContable->nombre=$request->nombre;
    	$cuentaContable->usuarioCreado=Auth::id();
    	$cuentaContable->save();
    	$request->session()->flash('success','Nueva cuenta contable creada');
        return redirect()->route('cuentas-contables');
    }
    public function nuevo()
    {
        return view('cuentasContables.nuevo');
    }

    public function editar($idCuentaContable)
    {
        $cuentaContable=CuentaContable::findOrFail($idCuentaContable);
        $this->authorize('materialesCuentaContable', $cuentaContable);
    	$data = array('modelo' =>$cuentaContable);
	    return view('cuentasContables.editar',$data);
    	
    }
    public function actualizar(RqEditar $request)
    {
        $cuentaContable=CuentaContable::findOrFail($request->modelo);
        $this->authorize('materialesCuentaContable', $cuentaContable);
    	$cuentaContable->nombre=$request->nombre;
    	$cuentaContable->usuarioActualizado=Auth::id();
    	$cuentaContable->save();
    	$request->session()->flash('success','Cuenta Contable actualizada');
        return redirect()->route('cuentas-contables');
    }
    public function eliminar(Request $request)
    {
        $request->validate([
            'idCuentaContable'=>'required|exists:cuentaContable,id',
        ]);
        
        try {
            DB::beginTransaction();
            $cuentaContable=CuentaContable::findOrFail($request->idCuentaContable);
            $this->authorize('materialesCuentaContable', $cuentaContable);        
	        $cuentaContable->delete();
	        DB::commit();
            return response()->json(['success'=>'Cuenta contable eliminada']);        

        } catch (\Exception $th) {
            DB::rollBack();
            return response()->json(['default'=>'No se puede eliminar la cuenta contable']);
        }
    }
}
