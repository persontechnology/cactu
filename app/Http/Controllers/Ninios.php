<?php

namespace cactu\Http\Controllers;

use DirectoryIterator;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use cactu\DataTables\NinioDataTable;
use cactu\Http\Requests\Ninios\RqCrearNinio;
use cactu\Http\Requests\Ninios\RqCrearNinioAfiliado;
use cactu\Http\Requests\Ninios\RqEditar;
use cactu\Imports\NiniosImport;
use cactu\Imports\NumerosNiniosImport;
use cactu\Models\Buzon\BuzonCarta;
use cactu\Models\CarpetaNinio;
use cactu\Models\Familia;
use cactu\Models\Localidad\Canton;
use cactu\Models\Localidad\Comunidad;
use cactu\Models\Ninio;
use cactu\Models\Registro\Listado;
use cactu\Models\TipoArchivo;
use cactu\Models\TipoParticipante;


class Ninios extends Controller
{
  public function __construct()
  {
      $this->middleware(['auth','role_or_permission:Administrador|G. de niños']);
      set_time_limit(8000000);
  }
  public function index(NinioDataTable  $dataTable)
  {

      $tipoParticipante=TipoParticipante::get();
      return  $dataTable->render('ninios.index',['tipoParticipante'=>$tipoParticipante]);
  }
  public function subirNinios()
  {    	
  	return view('ninios.subirNinios');    	
  }
  public function importarArchivo(Request $request)
  {
  	$this->validate($request,[
  		'archivo'=>'required|mimes:xls,xlsx|max:470'
    ]);
    try {    	
    Excel::import(new NiniosImport, request()->file('archivo'));
  } catch (\Exception $ex) {
    return back()->with('error', 'Los participantes no pueden ser importados verifique el excel');            
}
    $request->session()->flash('success','Participantes creado exisosamente');
      return redirect()->route('ninios');
  }
  public function informacion($idNinio)
  {
    $ninio=Ninio::findOrFail($idNinio);
    $asistencias=$ninio->listados()->limit(3)->get();
    $contador=$ninio->listados()->count();
    $data = array('ninio' =>$ninio ,'asistencias'=> $asistencias,'contador'=>$contador );
   
    return view('ninios.informacion',$data);
  }
  public function nuevoAfialiado($idtipoParticipante)
  {
    $tipoParticipante=TipoParticipante::findOrFail($idtipoParticipante);    
    $this->authorize('crearNuevoTipoParticipante',$tipoParticipante);    
    $cantones=Canton::get();
    if($tipoParticipante->nombre=='INNAJ Inscritos/afiliados'){
      return view('ninios.nuevoAfiliado',['tipoParticipante'=>$tipoParticipante,'cantones'=>$cantones]);
    }else{
      return view('ninios.nuevoNinio',['tipoParticipante'=>$tipoParticipante,'cantones'=>$cantones]);
    }      
  }

  public function guardarNinioafilia(RqCrearNinioAfiliado $request)
  {
     $tipoParticipante=TipoParticipante::findOrFail($request->tipoParticipante);
     $comunidad=Comunidad::findOrFail($request->comunidad);
     $token=Str::random(100);
     $ninio= new Ninio();
     $ninio->casoParticipante=$request->casoParticipante;
     $ninio->numeroChild=$request->numeroChild; 
      $ninio->token=$token;
     $ninio->nombres=$request->nombres;
     $ninio->genero=$request->genero;
     $ninio->fechaNacimiento=$request->fechaNacimiento;
     $ninio->estadoPatrocinio=$request->estadoPatrocinio;
     $ninio->fechaRegistro=$request->fechaRegistro;
     $ninio->latitud=$request->latitud;
     $ninio->longitud=$request->longitud;
     $ninio->comunidad_id=$comunidad->id;
     $ninio->tipoParticipante_id=$tipoParticipante->id;
     $ninio->celular=$request->celular;
     $ninio->email=$request->email;
     $ninio->creadoPor=Auth::id();
     $ninio->save();
     $request->session()->flash('success','Participante creado exisosamente en '. $tipoParticipante->nombre.' en la comunidad de '.$comunidad->nombre);
      return redirect()->route('ninios');
   }
   public function guardarNinio(RqCrearNinio $request)
  {
     $tipoParticipante=TipoParticipante::findOrFail($request->tipoParticipante);
     $comunidad=Comunidad::findOrFail($request->comunidad);
     $ninio= new Ninio();
     $ninio->casoParticipante=$request->casoParticipante;     
     $ninio->nombres=$request->nombres;
     $ninio->genero=$request->genero;
     $ninio->fechaNacimiento=$request->fechaNacimiento;
     $ninio->estadoPatrocinio=$request->estadoPatrocinio;
     $ninio->fechaRegistro=$request->fechaRegistro;
     $ninio->latitud=$request->latitud;
     $ninio->longitud=$request->longitud;
     $ninio->comunidad_id=$comunidad->id;
     $ninio->tipoParticipante_id=$tipoParticipante->id;
     $ninio->creadoPor=Auth::id();
     $ninio->save();
     $request->session()->flash('success','Participante creado exisosamente en '. $tipoParticipante->nombre.' en la comunidad de '.$comunidad->nombre);
      return redirect()->route('ninios');
   }

  public function editarNinio($idNinio)
  {     
     $ninio=Ninio::findOrFail($idNinio);
     $tipoParticipante=TipoParticipante::get();
     $cantones=Canton::get();
     return view('ninios.editar',['ninio'=>$ninio,'tipoParticipante'=>$tipoParticipante,'cantones'=>$cantones]);
  }
  public function actualizarNinio(RqEditar $request)
  {
    
     $ninio= Ninio::findOrFail($request->ninio);
     $tipoParticipante=TipoParticipante::where('id',$request->tipoParticipante)->first();
     $ninio->casoParticipante=$request->casoParticipante;
     $token=Str::random(100);
     if($tipoParticipante->nombre=="INNAJ Inscritos/afiliados"){
       $ninio->numeroChild=$request->numeroChild;
       if(!$ninio->token){
         $ninio->token=$token;

       }   
     }else{
      $ninio->numeroChild=null;
     }
     $ninio->nombres=$request->nombres;
     $ninio->genero=$request->genero;
     $ninio->fechaNacimiento=$request->fechaNacimiento;
     $ninio->estadoPatrocinio=$request->estadoPatrocinio;
     $ninio->fechaRegistro=$request->fechaRegistro;
     $ninio->latitud=$request->latitud;
     $ninio->longitud=$request->longitud;
     $ninio->tipoParticipante_id=$request->tipoParticipante;
     $ninio->comunidad_id=$request->comunidad_id;
     $ninio->celular=$request->celular;
     $ninio->email=$request->email;
     $ninio->actualizadoPor=Auth::id();
     $ninio->save();
     $request->session()->flash('success','Participante actualizaso exitosamente !');
      return redirect()->route('ninios');
  }
  
  function eliminarNinio(Request $request)
  {
      $request->validate([
          'ninio'=>'required|exists:ninio,id',
      ]);

      try {
          DB::beginTransaction();
          $ninio=Ninio::findOrFail($request->ninio);
          $familia=Familia::where('ninio_id',$ninio->id)->first();
          if($familia){
            $familia->delete();
          }   
          $ninio->delete();
          DB::commit();
          return response()->json(['success'=>'Niño eliminado']);

      } catch (\Exception $th) {
          DB::rollBack();
          return response()->json(['default'=>'No se puede eliminar al participante']);
      }
  }

    //A:Deivid
    //D:Generar codigo Qr de niño
    public function qr($idNinio)
    {
        $ninio=Ninio::findOrFail($idNinio);
        $pdf = PDF::setPaper('a6')->loadView('ninios.qr', ['ninio'=>$ninio]);
        return $pdf->inline();
    }
    // A:Deivid
    // D:Descargar qrs de todos los niños

    public function qrPdf($idComunidad)
    {
      $comunidad=Comunidad::findOrFail($idComunidad);
      $ninios=$comunidad->ninios;
      $pdf = PDF::setPaper('a6')->loadView('ninios.qrTodos', ['ninios'=>$ninios]);
      return $pdf->download('qrs-niños.pdf');
    }

    // A:deivid
    // D:descargar información de ninio a PDF
    public function ninioInformacionPdf($idNinio)
    {
      $user=Ninio::findOrFail($idNinio);
      $pdf = PDF::loadView('ninios.pdf',['ninio'=>$user]);
      return $pdf->inline();
    }

    public function ninioInformacionImprimir($idNinio)
    {
      $user=Ninio::findOrFail($idNinio);
      return view('ninios.imprimir',['ninio'=>$user]);
    }


    // A:deivid
    // D: descargar qrs por comunidad
    public function descargarQrs()
    {
      $comunidades=Comunidad::all();
      $data = array('comunidades' => $comunidades );
      return view('ninios.descargarQr',$data);
    }

    //A:fabian
    //funcion para mostrar las asistencias de cada ninio en base a su id 
    public function consultaNinio(Request $reques )
    {
      try {
        // $ninio=Ninio::findOrFail(4149);
        $ninio=Ninio::findOrFail(Crypt::decryptString($reques->getIp));
        $asistencias=Listado::where('ninio_id',$ninio->id)
        ->with([
          'asistencia'=>function($query){
              $query->select('id','fecha','user_id','comunidadPoaParticipante_id');
          },
          'asistencia.responsable'=>function($query){
            $query->select('id','name');
          },
          'asistencia.comunidadPoaParticipante'=>function($query){
            $query->select('id','comunidad_id','poaParticipante_id');
          },
          'asistencia.comunidadPoaParticipante.comunidad'=>function($query){
            $query->select('id','nombre');
          },
          'asistencia.comunidadPoaParticipante.poaParticipante'=>function($query){
            $query->select('id','poa_id');
          },
          'asistencia.comunidadPoaParticipante.poaParticipante.poa'=>function($query){
            $query->select('id','planificacionModelo_id','actividad_id');
          },
          'asistencia.comunidadPoaParticipante.poaParticipante.poa.actividad'=>function($query){
            $query->select('id','codigo','modeloProgramatico_id');
          },
          'asistencia.comunidadPoaParticipante.poaParticipante.poa.actividad.modeloProgramatico'=>function($query){
            $query->select('id','codigo');
          },
          'asistencia.comunidadPoaParticipante.poaParticipante.poa.planificacionModelo'=>function($query){
            $query->select('id','planificacion_id');
          },
          'asistencia.comunidadPoaParticipante.poaParticipante.poa.planificacionModelo.planificacion'=>function($query){
            $query->select('id','nombre');
          }
        ])->orderBy('created_at','desc')
        ->get(['id','asistencia_id','ninio_id','created_at']);
        return response()->json(['ok'=>$asistencias,'nombres'=>$ninio->nombres]);
      } catch (\Throwable $th) {
        return response()->json(['mjs'=>$th]);
      }
    }

    /*
      *Desde aki tenemos los cambios realizados para subir archivos.
      *recordar que los ninios tienen un serie de documntos que se deben archivar a la carpeta 
    */
    public function buscarNinioArchivos(Request $request)
    {
      if ($request->ajax()) {

        try {
                $idNinio=Crypt::decryptString($request->getIp);
                
                $ninio=Ninio::with(['comunidad:id,nombre',
                  'tipoParticipante:id,nombre',
                ])->findOrFail($idNinio);
                $this->authorize('verAfiliado',$ninio);  
                 $tipos= TipoArchivo::count();
                 $ninioCarpeta=CarpetaNinio::where('ninio_id',$ninio->id)
                 ->with('tipoArchivo:id,nombre')
                 ->with('ninio:id,nombres')
                 ->get();
                 $noexiste=TipoArchivo::whereNotIn('id',$ninioCarpeta->pluck('tipoarchivo_id'))->get();
                                  
                return response()->json(['ok'=>  $ninio,'ex'=>$ninioCarpeta,'noex'=> $noexiste,'num'=>$tipos]);
              } catch (DecryptException $e) {
                return response()->json(['msj'=>"Los datos ingresados son incorrectos"]);
            }
        }else{
          return response()->json(['msj'=>"Los datos ingresados son incorrectos"]);
      }
    }
    public function creaArchiivoCarpeta(Request $request)
    {
      $validatedData = $request->validate([
        'archivo' => 'required|mimes:pdf|max:50000',
        'getid'=>'required',
        'getip'=>'required'
    ]);
    $user=Ninio::findOrFail(Crypt::decryptString($request->getip));
    $num = 0;
    $num = $request->getid;
    $tipoArchivo=TipoArchivo::findOrFail($num);
      if($validatedData){
        $carpeta=CarpetaNinio::where('ninio_id',$user->id)->where('tipoarchivo_id', $tipoArchivo->id)->count();
         if ($request->hasFile('archivo') && $carpeta==0) {
            if ($request->file('archivo')->isValid()) {                
                $archivo=$tipoArchivo->nombre.'_'.$user->nombres.'_'.rand(0,20).'.'.$request->archivo->extension();
                $path = $request->archivo->storeAs('carpeta', $archivo,'public');
                $carpetaGuardar= new CarpetaNinio();
                $carpetaGuardar->ninio_id=$user->id;
                $carpetaGuardar->tipoarchivo_id=$tipoArchivo->id;
                $carpetaGuardar->archivo=$archivo;
                $carpetaGuardar->creadoPor=Auth::id();
                $carpetaGuardar->save();
                return response()->json(['success'=>$tipoArchivo->id]);
            }else{
                return response()->json(['error'=>'No se puede subir el archivos-'.$tipoArchivo->id]);
            }
            
         }else{
             return response()->json(['error'=>'No se puede subir el archivos-'.$tipoArchivo->id]);
         }
        }else{
          return response()->json(['error'=>'no puede subir-'.$tipoArchivo->id]);
      }
       
    }
    public function actualizarCarpeta(Request $request)
    {
      $validatedData = $request->validate([
        'archivo' => 'required|mimes:pdf|max:50000',
        'getid'=>'required',
        'getip'=>'required'
       ]);
        if($validatedData){
        $user=Ninio::findOrFail(Crypt::decryptString($request->getip));
        $tipoArchivo=TipoArchivo::findOrFail($request->getid);
        $carpeta=CarpetaNinio::where('ninio_id',$user->id)->where('tipoarchivo_id', $tipoArchivo->id)->count();
         if ($request->hasFile('archivo') && $carpeta==1) {
            if ($request->file('archivo')->isValid()) {                
                $carpetaGuardar= CarpetaNinio::findOrFail($request->getipac);
                Storage::disk('public')->delete('carpeta/'.$carpetaGuardar->archivo);
                $archivo=$tipoArchivo->nombre.'_'.$user->nombres.'_'.rand(0,20).'.'.$request->archivo->extension();
                $path = $request->archivo->storeAs('carpeta', $archivo,'public');
                $carpetaGuardar->archivo=$archivo;                
                $carpetaGuardar->actualizadoPor=Auth::id();
                $carpetaGuardar->save();
                $preview = Storage::url('public/carpeta/'.$carpetaGuardar->archivo);
  
                return response()->json(
                  [
                    'initialCaption'=>$carpetaGuardar->archivo,
                    'initialPreview' => $preview ,
                    'initialPreviewConfig' => [
                        // pass exif object below for `autoOrientImageInitial` detection 
                        // it must contain the `Orientation` property
                        ['type'=>'pdf','caption' => $carpetaGuardar->tipoArchivo->nombre, 'url' => route('eliminararchivoPart'), 'key' => $carpetaGuardar->id] 
                        
                   ]
                  ]
                );
            }else{
                return response()->json(['error'=>'No se puede subir el archivo ff']);
            }
            
        }else{
            return response()->json(['error'=>'No se puede subir el archivo']);
        }
      }else{
        return response()->json(['error'=>'No se puede subir el archivo']);
    }
       
    }
    function eliminarCarpeta (Request $request){
      $carpeta=CarpetaNinio::findOrFail($request->key);
      $carpeta->delete();
      Storage::disk('public')->delete('carpeta/'.$carpeta->archivo);
      return response()->json(['success'=>$carpeta]);
    }
    public function buscarFiles()
    {
      $dir_path  =Storage::files('public/cart');
      $ont=0;
      foreach ($dir_path as $dirq) {
        if($ont<50){
        $url = Storage::url($dirq);
        $conca=explode('/',$url);
        $cnombre=explode('_',$conca[3]);
        $notipo=$cnombre[0];
        $pnombres=$cnombre[1].' '.$cnombre[2];
        $papeliidos=$cnombre[3].' '.$cnombre[4];
        $totalNo=$pnombres.' '.$papeliidos;
        // echo $totalNo.'</br>';
        $ninio=Ninio::where('nombres',$totalNo)->first();
        $tiarchivo=TipoArchivo::where('nombre',$notipo)->first();
        if($ninio &&  $tiarchivo){
          $carpetaexiste=CarpetaNinio::where('ninio_id',$ninio->id)
          ->where('tipoArchivo_id',$tiarchivo->id)->count();
          if($carpetaexiste==0){
            // $inicio= storage_path('app/public/cart/'.$conca[3]);
            // $fin=public_path('carpeta/'.$conca[3]);
            // Storage::copy($inicio, $fin);
            $carpetaGuardar= new CarpetaNinio();
            $carpetaGuardar->ninio_id=$ninio->id;
            $carpetaGuardar->tipoarchivo_id=$tiarchivo->id;
            $carpetaGuardar->archivo=$conca[3];
            $carpetaGuardar->creadoPor=Auth::id();
            $carpetaGuardar->save();
            echo $ninio->id.'tipo'.$tiarchivo->id."</br>";

          }

        }

        }
        $ont ++;
      }
     
    }
      /*
      *Descripcion: en estas funciones seran implementadas para el modulo de mensajería
      *Autor:Fabian López
      *Fecha Junio 2020
    */
    public function actualizarDoto()
    {
      $tipoParticipante=TipoParticipante::where('nombre','INNAJ Inscritos/afiliados')->first();
      if($tipoParticipante){
        $ninios=$tipoParticipante->ninios()->get(['id']);
        foreach ($ninios as $ninioa ) {
            $token=Str::random(100);
           $ninio=Ninio::findOrFail($ninioa->id);
           $ninio->token=$token;
           $ninio->save();
        }
        
      }
    }
    public function numeroNinos()
    {
      return view('ninios.subirNumeros');
    }
    public function subirNumeros(Request $request)
    {
      $this->validate($request,[
        'archivo'=>'required
        '
      ]);
      try {    	
      Excel::import(new NumerosNiniosImport, request()->file('archivo'));
    } catch (\Exception $ex) {
      return $ex;            
    }
  }
   /*
      *Descripcion: en estas funciones seran implementadas para el modulo de mensajería
      *Autor:Fabian López
      *Fecha Junio 2020
    */

    public function buzon($idNinio)
    {
      $ninio=Ninio::findOrFail($idNinio);

      $buzones=$ninio->buzones()->paginate(10);
      $data = array('ninio' =>$ninio ,'buzones'=>$buzones );
      return view('ninios.buzon',$data);
    }
    public function vistaCarta($idCartaBuzon)
    {
      try {
        $idBuzon=Crypt::decryptString($idCartaBuzon);
        $buzonCarta=BuzonCarta::findOrFail($idBuzon);
        $buzonTipo=$buzonCarta->tipo_cartas_id;
        $buzonTipoNombre=$buzonCarta->tipoCarta->nombre;
        $user=Ninio::findOrFail($buzonCarta->buzon->ninio_id);          
      
        $data = array('buzonCarta' => $buzonCarta,'ninio'=>$user);
        return view('ninios.miParticipantes.buzon.reportes.documento',$data);
      } catch (DecryptException $e) {
        return response()->json(['msj'=>"Los datos ingresados son incorrectos"]);
      }
    }

    public function exportarCartasPdf($idCartaBuzon)
    {
     try {
        $idBuzon=Crypt::decryptString($idCartaBuzon);
        $buzonCarta=BuzonCarta::findOrFail($idBuzon);
        $buzonTipo=$buzonCarta->tipo_cartas_id;
        $buzonTipoNombre=$buzonCarta->tipoCarta->nombre;
        $user=Ninio::findOrFail($buzonCarta->buzon->ninio_id);          
  
            $data = array('buzonCarta' => $buzonCarta,'ninio'=>$user);
            $pdf = PDF::loadView('ninios.miParticipantes.buzon.reportes.respuestaCarta', $data)
            // ->setOrientation('landscape')
            ->setPaper('a4');
                
            return $pdf->inline($buzonCarta->tipoCarta->nombre.'_'.$user->nombres.'.pdf');
          } catch (DecryptException $e) {
            return response()->json(['msj'=>"Los datos ingresados son incorrectos"]);
          }
          
  }
}
