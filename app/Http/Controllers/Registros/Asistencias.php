<?php

namespace cactu\Http\Controllers\Registros;

use cactu\Exports\AsistenciaExposrt;
use Illuminate\Http\Request;
use cactu\Http\Controllers\Controller;
use cactu\Models\Ninio;
use cactu\Models\Planificacion;
use cactu\Models\Poa\PoaParticipantes\ComunidadPoaParticipante;
use cactu\Models\Poa\PoaParticipantes\PoaParticipante;
use cactu\Models\Registro\Asistencia;
use cactu\Models\Registro\ListaCuentaContablePoaCuenta;
use cactu\Models\Registro\Listado;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Crypt;
USE PDF;

use Maatwebsite\Excel\Facades\Excel;


class Asistencias extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role_or_permission:Administrador|Registro de asistencia a actividades']);
    }
    
    public function index()
    {
        $plan=Planificacion::where('estado','proceso')->first();
        if($plan){
            $poas=$plan->poas()->whereHas('poaActividad',function(Builder $query){
                $query->whereHas('mesesConsula');
            })->whereHas('poaCuentaContable')->whereHas('poaParticipante')->get();
    
            $data = array(
                'plan' => $plan,
                'poas'=>$poas
            );
        }else{
            $data = array(
                'plan' => $plan,
                'poas'=>null
            );
        }
        
        return view('registros.asistencias.index',$data);
    }


    public function crear(Request $request)
    {
        $request->validate([
            'comupoaparti' => 'required|exists:comunidadPoaParticipante,id',
        ]);

        try {
            DB::beginTransaction();
            $comupoaparti=ComunidadPoaParticipante::findOrFail($request->comupoaparti);
            $this->authorize('accederAsistencias',$comupoaparti);    
            $asistencia=new Asistencia();
            $asistencia->comunidadPoaParticipante_id=$comupoaparti->id;
            $asistencia->estado='Creado';
            $asistencia->fecha=Carbon::now();
            $asistencia->creadoPor=Auth::id();
            $asistencia->user_id=Auth::id();
            $asistencia->save();

            DB::commit();
            $request->session()->flash('success','Asistencia creado exitosamente');

        } catch (\Exception $th) {
            DB::rollBack();
            $request->session()->flash('info','Asistencia no creado');
        }
        return redirect()->route('asistencias',$request->comupoaparti);
    }


    public function asistencias($idComunidadPoaParticipante)
    {
        $comuPoaParticipante=ComunidadPoaParticipante::findOrFail($idComunidadPoaParticipante);
        $this->authorize('accederAsistencias',$comuPoaParticipante);    
        $data = array('comuPoaParticipante' => $comuPoaParticipante );
        return view('registros.asistencias.lista',$data);
    }



    public function registrar($idAsistencia)
    {
        $asis=Asistencia::findOrFail($idAsistencia);
        $this->authorize('accederAsistencias',$asis->comunidadPoaParticipante);   
        $data = array('asis' => $asis ); 
        return view('registros.asistencias.registrar',$data);
        
    }

    public function guardar(Request $request)
    {
        try {
            $asis=Asistencia::findOrFail($request->asis);
            $ninio=Ninio::findOrFail($request->ninio);
            $this->authorize('accederAsistencias',$asis->comunidadPoaParticipante);
            
            // actualizar datos de ninio
            if (!$ninio->nombres){
                $ninio->nombres=$ninio->usuario->name;
                $ninio->save();
            }

            if($asis->comunidadPoaParticipante->comunidad->nombre!=$ninio->comunidad->nombre){
                return response()->json(['default'=>'Niño no pertenece a '.$asis->comunidadPoaParticipante->comunidad->nombre]);
            }
            
            $arrayTipoParticipantes=$asis->comunidadPoaParticipante->poaParticipante->tipoParticipantes->pluck('nombre');
            if(!$arrayTipoParticipantes->contains($ninio->tipoParticipante->nombre)){
                return response()->json(['default'=>'Niño no pertenece a ningun Tipo de participante']);
            }

            $listado=Listado::where('ninio_id',$ninio->id)->where('asistencia_id',$asis->id)->first();
            if($listado){
                return response()->json(['info'=>'Niño ya está registrado']);
            }else{
            
                $listado=new Listado();
                $listado->asistencia_id=$asis->id;
                $listado->ninio_id=$ninio->id;
                $listado->edad=Carbon::parse($ninio->fechaNacimiento)->age;
                $listado->afiliado=true;
                $listado->lugar=$ninio->comunidad->nombre;
                $listado->firma=$ninio->numeroChild;

                if($listado->save()){
                    if ($request->hasFile('foto')) {
                        if ($request->file('foto')->isValid()) {
                            $extension = $request->foto->extension();
                            $nombreFoto=$listado->id.'.jpg';
                            $path = Storage::putFileAs(
                                'public/asistencias/',$request->file('foto'),$nombreFoto
                            );
                            $url = Storage::url("public/asistencias/".$nombreFoto);
                           $listado->fotoQr=$url;
                           $listado->save();
                           
                        }                  
                    }
                    //desde aqui
                   
                }
                
                $data_res = array('success' =>'Niño registrado exitosamente');
                return response()->json($data_res);
            }
        } catch (\Exception $th) {
            return response()->json(['default'=>'Ocurrio un error, vuelva intentar.!']);
        }

    }

    public function cargaListado($idAsistencia)
    {

        $asis=Asistencia::findOrFail($idAsistencia);
        $this->authorize('accederAsistencias',$asis->comunidadPoaParticipante);   
        return view('registros.asistencias.tablaListado',['asis'=>$asis]);
    }


    public function actualiuzarCuentasContablesLista(Request $request)
    {
        $listado=Listado::findOrFail($request->lista);
        $this->authorize('accederAsistencias',$listado->asistencia->comunidadPoaParticipante);
        $listaCCPC=ListaCuentaContablePoaCuenta::where(['listado_id'=>$request->lista,'cuentaContablePoaCuenta_id'=>$request->cuentaContable])->first();

        if(!$listaCCPC){
            $listaCCPC=new ListaCuentaContablePoaCuenta();
            $listaCCPC->listado_id=$request->lista;
            $listaCCPC->cuentaContablePoaCuenta_id=$request->cuentaContable;
            $listaCCPC->save();
            return response()->json(['success'=>'Asignado']);
        }else{
            $listaCCPC->delete();
            return response()->json(['info'=>'Quitado']);
        }
    }


    public function actualizarOpcionLista(Request $request)
    {
        $lista=Listado::findOrFail($request->lista);
        $this->authorize('accederAsistencias',$lista->asistencia->comunidadPoaParticipante);
        try {
            
            $lista->opcion=$request->opcion;
            if($request->estado=='no'){
                $lista->opcion=null;
            }
            $lista->save();
            return response()->json(['success'=>'Actualizado']);
        } catch (\Exception $th) {
            return response()->json(['default'=>'Ocurrio un error, vuelva intentarlo']);
        }
    }

    public function actualizarDetalleAsistencia(Request $request)
    {
        $asis=Asistencia::findOrFail($request->asis);
        $this->authorize('accederAsistencias',$asis->comunidadPoaParticipante);
        try {
            $asis->detalle=$request->detalle;
            $asis->save();
            return response()->json(['success'=>'Guardado exitosamente']);
        } catch (\Throwable $th) {
            return response()->json(['default'=>'Ocurrio un error, vuelva intentarlo']);
        }
    }



    public function exportarPdf($idAsistencia)
    {
        $asistencia=Asistencia::findOrFail($idAsistencia);
        $this->authorize('accederAsistenciasPfd',$asistencia->comunidadPoaParticipante);
        $data = array('asis' => $asistencia,'noMostrar'=>'NO');
        $pdf = PDF::loadView('registros.asistencias.exportarPdf', $data)
        ->setOrientation('landscape')
        ->setPaper('a4')
        ->setOption('margin-top', '35')
        ->setOption('margin-bottom', '35')
        ->setOption('margin-left', '15mm')
        ->setOption('margin-right', '15mm')
        ->setOption('header-html', view('registros.asistencias.header'))
        ->setOption('footer-html', view('registros.asistencias.footer',['asis'=>$asistencia]));
        return $pdf->inline($asistencia->comunidadPoaParticipante->comunidad->nombre.'.pdf');
    }

    public function exportarExcel($idAsistencia) 
    {
        $asistencia=Asistencia::findOrFail($idAsistencia);
        $this->authorize('accederAsistenciasPfd',$asistencia->comunidadPoaParticipante);
        return Excel::download(new AsistenciaExposrt($idAsistencia), 'asistencia.xlsx');
    }
    /*
    *Esta función perimite mostrar los datos en la vistas para eliminar las participaciones sin asistencias. 
    public function eliminarSinParticipantes($idPlanificacion)
    {
        $fechaActual=Carbon::now();       
        $planificaion=Planificacion::findOrFail($idPlanificacion);
        $poaParticipante=PoaParticipante::whereIn('poa_id',$planificaion->poas->pluck('id'))->get(['id']);
        $comunidadesParticipantes=ComunidadPoaParticipante::whereIn('poaParticipante_id',$poaParticipante->pluck('id'))->get(['id']);
        $asiste=Asistencia::whereIn('comunidadPoaParticipante_id',$comunidadesParticipantes->pluck('id'))
        ->whereExists(function($query){
            $query->select(DB::raw(1))
                ->from('listados')
                ->whereRaw('listados.asistencia_id = asistencias.id');
            }
        )
        ->get(['id']);
      
        $asistenciasTotal=Asistencia::whereNotIn('id',$asiste->pluck('id'))
        ->whereDate('fecha','<',Carbon::parse($fechaActual)->toDateString())
        ->orderBy('fecha','desc')->paginate(10,['id','fecha','user_id','comunidadPoaParticipante_id']);     
        $data = array('asistencias' =>$asistenciasTotal,'planificacion' =>$planificaion,'fechaHoy'=>$fechaActual );
        return view('registros.asistencias.reportes.eliminar',$data); 
    }
    */
    /*
    *Tmar en cuenta es lo que no se debe hace dentro de las consultas
    public function listadoEliminar($idPlanificacion)
    {
        $planificaion=Planificacion::findOrFail($idPlanificacion);
        $fechaActual=Carbon::now();
        $idAsistencias = \collect([]);
        foreach ($planificaion->poas as $poa) {
            foreach ($poa->comunidadesParticipantes as $comunidad) {
                if($comunidad->asistencias->count()>0){
                    foreach ($comunidad->asistencias as $asistencia) {
                        if($asistencia->listado->count()==0){                            
                        $idAsistencias->push($asistencia->id);
                        }
                    } 
                }              
            }
        }
        $asistenciasTotal=Asistencia::whereIn('id',$idAsistencias)
        ->whereDate('fecha','<',Carbon::parse($fechaActual)->toDateString())
        ->orderBy('fecha','desc')->paginate(5);
        $data = array('asistencias' =>$asistenciasTotal,'fechaHoy'=>$fechaActual );
        return view('registros.asistencias.reportes.eliminar',$data); 
    }
    */
    /*
    // Este metodo será utilizado para eliminar todas las asistencias que no tiene participantes
    public function eliminarAsistencias(Request $request)
    {
        try {
            $asistencia=Asistencia::findOrFail($request->id);
            $asistencia->delete();
            return response()->json('success');
        } catch (\Throwable $th) {
            return response()->json('default');
        }
        
    }*/
    /*
    *En esta función muesta la vista para para realizar  la busqueda en base a una planificación
    public function vistaExportarExcelFechas($idPlanificacion){
        $planificacion=Planificacion::findOrFail($idPlanificacion);
        return view('registros.asistencias.reportes.exportarFechas',['planificacion'=>$planificacion]);
    }
    */
    /*
    * En esta función nos ayuda a relizar la busqueda en base a una fecha Inicio y fecha fin
    *
    public function exportarExcelFechas(Request $request)
    {
        if ($request->ajax()) {
            
            $token = $request->input('_token') ;
            $idpla=Crypt::decryptString($request->getIp);
            $fechaInicio=$request->fechaInicio;
            $fechaFin=$request->fechaFin;
            if ($token)
            {
                $planificacion=Planificacion::findOrFail($idpla);
                if($fechaInicio>= $planificacion->desde && $fechaFin<= $planificacion->hasta ){
                        $asistencia=Listado::whereDate('created_at','>=',$fechaInicio)
                        ->whereDate('created_at','<=',$fechaFin)
                        ->whereHas('ninio', function($query){
                            $query->whereNotNull('numeroChild'); 
                    })
                        ->with([
                            'asistencia'=>function($query){
                                $query->select('id','fecha');
                            },
                            'ninio'=>function($query){
                                
                                $query->select('id','nombres','numeroChild');
                            }                
                        ])       
                        ->get(['id','ninio_id','asistencia_id']);

                        return response()->json(["ok"=>$asistencia,"plani"=>$planificacion]);
                    }else{
                        return response()->json(["msj"=>"Los datos ingresados son incorrectos"]);
                    }
            }
            return response()->json(['msj'=>"Alteración de datos"]);
        }else{
            return response()->json(['msj'=>"Los datos ingresados son incorrectos"]);
        }
     
    }
    */
}
