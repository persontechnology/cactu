<?php

namespace cactu\Http\Controllers\Localidad;

use Illuminate\Http\Request;
use cactu\Http\Controllers\Controller;
use cactu\DataTables\Localidad\ComunidadesEnCantonDataTable;
use cactu\Models\Localidad\Canton;
use cactu\Http\Requests\Localidad\Comunidad\RqGuardar;
use cactu\Models\Localidad\Comunidad;
use Illuminate\Support\Facades\DB;
use cactu\Http\Requests\Localidad\Comunidad\RqActualizar;
use cactu\DataTables\Localidad\ComunidadesCantonDataTable;
use cactu\DataTables\Localidad\ComunidadDataTable;
use Maatwebsite\Excel\Facades\Excel;
use cactu\Imports\ComunidadesImport;
use cactu\Models\Planificacion;
use cactu\User;

class Comunidades extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role_or_permission:Administrador|G. de comunidades']);
    }


    public function index(ComunidadDataTable $dataTable)
    {
      
        return $dataTable->render('localidad.comunidades.index');
    }

    public function guardar(RqGuardar $request)
    {
        $canton=Canton::findOrFail($request->canton);
        $user=User::findOrFail($request->gestor);
        if($user->hasRole('Gestor')){
            Comunidad::create(
                [
                    'nombre'=>$request->nombre,
                    'codigo'=>$request->codigo,
                    'user_id'=>$request->gestor,
                    'canton_id'=>$canton->id,
                ]
            );
            $request->session()->flash('success','Comunidad ingresado');
        }else{
            $request->session()->flash('info','Usuario gestor seelecionado es inválido');
        }
        return  redirect()->route('comunidades');
    }


    // A: deivid
    // D: actualizar gestor, tambien se cambia en las actividades comunidadPoaParticipante
    public function editar($idComunidad)
    {
        $canton=Canton::all();
        $gestores=User::role('Gestor')->get();
        $comunidad=Comunidad::findOrFail($idComunidad);
        $data = array('cantones' =>$canton ,'gestores'=>$gestores,'comunidad'=>$comunidad );

        return view('localidad.comunidades.editar',$data);
    }
    // comuniades en solo canton
    public function comunidadesSoloCanton(ComunidadesCantonDataTable $dataTable,$idCanton)
    {
        $canton=Canton::findOrFail($idCanton);
        $gestores=User::role('Gestor')->get();
        $data = array('canton' => $canton,'gestores'=>$gestores );
        return $dataTable->with('canton',$canton)->render('localidad.comunidades.comunidadesCanton',$data);
    }



    public function editarComunidadEnCantonSolo($idComunidad)
    {
        $canton=Canton::all();
        $gestores=User::role('Gestor')->get();       
        $comunidad=Comunidad::findOrFail($idComunidad);   
        $data = array('cantones' =>$canton ,'gestores'=>$gestores,'comunidad'=>$comunidad );

        return view('localidad.comunidades.editarCanton',$data);
    }

    public function actualizar(RqActualizar $request)
    {

        $user=User::findOrFail($request->gestor);
        if($user->hasRole('Gestor')){
            $comunidad=Comunidad::findOrFail($request->comunidad);
            if($comunidad->nombre=="CACTU-COTOPAXI" || $comunidad->nombre=="CACTU-TUNGURAHUA"){
            }else{
                $comunidad->nombre=$request->nombre;
            }
            $comunidad->codigo=$request->codigo;
            $comunidad->user_id=$request->gestor;
            $comunidad->canton_id=$request->canton;

            $comunidad->save();
            
            $this->actualizarGestorEnComunidadPoaParticipante($request->comunidad,$request->gestor);

            $request->session()->flash('success','Comunidad actualizado');
        }else{
            $request->session()->flash('info','Usuario gestor seelecionado es inválido');
        }
        
        return  redirect()->route('comunidades');
    }

    public function actualizarcomunidadEnCantonSolo(RqActualizar $request)
    {
        $user=User::findOrFail($request->gestor);
        if($user->hasRole('Gestor')){
            $comunidad=Comunidad::findOrFail($request->comunidad);
            if($comunidad->nombre=="CACTU-LATACUNGA" || $comunidad->nombre=="CACTU-AMBATO"){
            }else{
                $comunidad->nombre=$request->nombre;
            }
            $comunidad->codigo=$request->codigo;
            $comunidad->user_id=$request->gestor;
            $comunidad->canton_id=$request->canton;
            $comunidad->save();
            $this->actualizarGestorEnComunidadPoaParticipante($request->comunidad,$request->gestor);
            $request->session()->flash('success','Comunidad actualizado');
        }else{
            $request->session()->flash('success','Usuario gestor seelecionado es inválido');
        }
        
        
        return  redirect()->route('comunidadesSoloCanton',$comunidad->canton->id);
    }
    
    
    // comunidades en provincia-cantones

    public function comunidadesEnCanton(ComunidadesEnCantonDataTable $dataTable, $idCanton)
    {
        $canton=Canton::findOrFail($idCanton);
        $gestores=User::role('Gestor')->get();
        $data = array('canton' => $canton,'gestores'=>$gestores );
        return $dataTable->with('canton',$canton)->render('localidad.comunidades.comunidadesEnCanton',$data);
    }
  

    public function editarComunidadEnCanton($idComunidad)
    {
        $canton=Canton::all();
        $gestores=User::role('Gestor')->get();       
        $comunidad=Comunidad::findOrFail($idComunidad);   
        $data = array('cantones' =>$canton ,'gestores'=>$gestores,'comunidad'=>$comunidad );
        return view('localidad.comunidades.editarEnCanton',$data);
    }

    public function actualizarcomunidadEnCanton(RqActualizar $request)
    {
        $comunidad=Comunidad::findOrFail($request->comunidad);
        $user=User::findOrFail($request->gestor);
        if($user->hasRole('Gestor')){
            if($comunidad->nombre=="CACTU-COTOPAXI" || $comunidad->nombre=="CACTU-TUNGURAHUA"){
            }else{
                $comunidad->nombre=$request->nombre;
            }
            $comunidad->codigo=$request->codigo;
            $comunidad->canton_id=$request->canton;
            $comunidad->user_id=$request->gestor;
            $comunidad->save();
            $this->actualizarGestorEnComunidadPoaParticipante($request->comunidad,$request->gestor);
            $request->session()->flash('success','Comunidad actualizado');
        }else{
            $request->session()->flash('success','Usuario gestor seelecionado es inválido');
        }
        
        return  redirect()->route('coomunidadesEnCanton',$comunidad->canton->id);
    }

    public function eliminar(Request $request)
    {
        $request->validate([
            'comunidad'=>'required|exists:comunidad,id',
        ]);

        try {
            
            DB::beginTransaction();
            $comunidad=Comunidad::findOrFail($request->comunidad);
            $this->authorize('eliminarComunidad', $comunidad);
            if($comunidad->nombre=="CACTU-COTOPAXI" || $comunidad->nombre=="CACTU-TUNGURAHUA"){
                return response()->json(['default'=>'No puede eliminar comunidad '.$comunidad->nombre]);
            }else{
                $comunidad->delete();
                DB::commit();
                return response()->json(['success'=>'Comunidad eliminado']);
            }
            

        } catch (\Exception $th) {
            DB::rollBack();
            return response()->json(['default'=>'No se puede eliminar comunidad']);
        }
    }

    public function importar()
    {
        return view('localidad.comunidades.importar');
    }
    
    public function procesarImportacion(Request $request)
    {
        $request->validate([
            'archivo' => 'required'
        ]);
        Excel::import(new ComunidadesImport, $request->file('archivo'));
        return redirect()->route('comunidades')->with('success', 'Comunidades importados');
        
    }

    public function nuevo()
    {
        $canton=Canton::all();
        $gestores=User::role('Gestor')->get();
        $data = array('cantones' =>$canton ,'gestores'=>$gestores );
        return view('localidad.comunidades.nuevo',$data);
    }
    

    // A: deivid
    // D: actualizar los gestores en comunidadPoaParticipante
    public function actualizarGestorEnComunidadPoaParticipante($idComunidad,$idGestor)
    {
        $planificacion=Planificacion::where('estado','proceso')->first();
            if($planificacion){
                foreach ($planificacion->poas as $poa) {
                    $comunidadesPoaPar= $poa->poaParticipante->comunidadPoaParticipantes->where('comunidad_id',$idComunidad);
                    foreach ($comunidadesPoaPar as $comPoaPar) {
                        $comPoaPar->gestor_id=$idGestor;
                        $comPoaPar->save();
                    }
                }
                
            }
        
    }

    
}
