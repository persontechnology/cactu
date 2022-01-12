<?php

namespace cactu\Http\Controllers;

use Illuminate\Http\Request;
use cactu\Models\TipoParticipante;
use cactu\DataTables\TipoParticipanteDataTable;
use Illuminate\Support\Facades\Auth;
use cactu\Http\Requests\TipoParticipantes\RqCrear;
use cactu\Http\Requests\TipoParticipantes\RqEditar;
use Illuminate\Support\Facades\DB;
class TipoParticipantes extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role_or_permission:Administrador|G. de tipo de participantes']);
    }
    /*Autor:Fabian Lopez
    Descripcion:En esta funcion se muestra los datos de los tipo participantes*/
    public function index(TipoParticipanteDataTable $dataTable)
    {
    	return  $dataTable->render('tipoParticipantes.index');
    }

    public function nuevo()
    {
        return  view('tipoParticipantes.nuevo');
    }
    public function guardar(RqCrear $request)
    {
    	$modelo= new TipoParticipante;
    	$modelo->nombre=$request->nombre;
    	$modelo->usuarioCreado=Auth::id();
    	$modelo->save();
    	$request->session()->flash('success','Nuevo tipo de participante registrado');
        return redirect()->route('tipos-participante');
    }
    public function editar($idTipoParticipante)
    {
    	$tipoParticipacion=TipoParticipante::findOrFail($idTipoParticipante);
        $data = array('modelo' =>$tipoParticipacion);
        return view('tipoParticipantes.editar',$data);
    	
    }
    public function actualizar(RqEditar $request)
    {
        $modelo=TipoParticipante::findOrFail($request->modelo);
        $this->authorize('actualizar', $modelo);
    	$modelo->nombre=$request->nombre;
    	$modelo->usuarioActualizado=Auth::id();
    	$modelo->save();
    	$request->session()->flash('success','Tipo de participante actualizado');
        return redirect()->route('tipos-participante');
    }
    public function eliminar(Request $request)
    {
        $request->validate([
            'idTipoParticipante'=>'required|exists:tipoParticipante,id',
        ]);

        try {
            DB::beginTransaction();
            $tipoParticipacion=TipoParticipante::findOrFail($request->idTipoParticipante);
            $this->authorize('eliminar', $tipoParticipacion);
	        $tipoParticipacion->delete();
	        DB::commit();
            return response()->json(['success'=>'Tipo de participante eliminado']);

        } catch (\Exception $th) {
            DB::rollBack();
            return response()->json(['default'=>'No se puede eliminar el tipo de participante']);
        }
    }
}
