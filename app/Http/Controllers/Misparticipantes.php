<?php

namespace cactu\Http\Controllers;

use cactu\DataTables\MisParticipantesDataTable;
use cactu\Http\Requests\Ninios\RqCrearNinioAfiliado;
use cactu\Http\Requests\Ninios\RqEditar;
use cactu\Http\Requests\Ninios\RqFamilia;
use cactu\Models\Buzon\Buzon;
use cactu\Models\Buzon\BuzonCarta;
use cactu\Models\Buzon\BuzonCartaBoleta;
use cactu\Models\Buzon\TipoCarta;
use cactu\Models\CarpetaNinio;
use cactu\Models\Familia;
use cactu\Models\Localidad\Canton;
use cactu\Models\Localidad\Comunidad;
use cactu\Models\Ninio;
use cactu\Models\Buzon\MensajeNinio;
use cactu\Models\TipoArchivo;
use cactu\Models\TipoParticipante;
use cactu\Notifications\NotificacionEnvioCartas;
use cactu\User;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PDF;


class Misparticipantes extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(MisParticipantesDataTable $dataTable)
    {
        $tipoParticipante=TipoParticipante::get();
        return  $dataTable->render('ninios.miParticipantes.index',['tipoParticipante'=>$tipoParticipante]);
    }

   
    public function nuevo($idtipoParticipante)
    {
        $tipoParticipante=TipoParticipante::findOrFail($idtipoParticipante);    
        $this->authorize('crearNuevoTipoParticipante',$tipoParticipante);    
        $comunidades=Auth::user()->comunidades;
        return view('ninios.miParticipantes.nuevoAfiliado',['tipoParticipante'=>$tipoParticipante,'comunidades'=>$comunidades]);
          
    }

 
    public function guardarAfiliado(RqCrearNinioAfiliado $request)
    {
        $tipoParticipante=TipoParticipante::findOrFail($request->tipoParticipante);
        $comunidad=Comunidad::findOrFail($request->comunidad);
        $this->authorize('verificarComunidad', $comunidad);
        $token=Str::random(100);
        $ninio= new Ninio();
        $ninio->casoParticipante=$request->casoParticipante;
        if($request->numeroChild){
            $ninio->numeroChild=$request->numeroChild;
            if(!$ninio->token){
              $ninio->token=$token;     
            } 
        }
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
        return redirect()->route('misParticipantes');
    }

    public function editar($idNinio)
    {     
        $ninio=Ninio::findOrFail($idNinio);
        $this->authorize('actualizarMiPersonal', $ninio);
        $tipoParticipante=TipoParticipante::get();
        $cantones=Canton::get();
        return view('ninios.miParticipantes.editar',['ninio'=>$ninio,'tipoParticipante'=>$tipoParticipante,'cantones'=>$cantones]);
    }

    public function actualizar(RqEditar $request)
    {
       $ninio= Ninio::findOrFail($request->ninio);
       $this->authorize('actualizarMiPersonal', $ninio);
       $tipoParticipante=TipoParticipante::where('id',$request->tipoParticipante)->first();
       $token=Str::random(100);
       $ninio->casoParticipante=$request->casoParticipante;
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
        return redirect()->route('misParticipantes');
    }


    function eliminar(Request $request)
    {
        $request->validate([
            'ninio'=>'required|exists:ninio,id',
        ]);

        try {
            DB::beginTransaction();
            $ninio=Ninio::findOrFail($request->ninio);
            $this->authorize('eliminarMiPersonal', $ninio);
            $familia=Familia::where('ninio_id',$ninio->id)->first();
            if($familia){
                $familia->delete();
            }   
            $ninio->delete();
            DB::commit();
            return response()->json(['success'=>'Participante eliminado']);

        } catch (\Exception $th) {
            DB::rollBack();
            return response()->json(['default'=>'No se puede eliminar participante']);
        }
    }

    public function informacion($idNinio)
    {
        $ninio=Ninio::findOrFail($idNinio);
        $this->authorize('informacionMiPersonal', $ninio);
        $data = array('ninio' =>$ninio , );
        return view('ninios.miParticipantes.informacion',$data);
    }

    public function informacionPdf($idNinio)
    {
        $user=Ninio::findOrFail($idNinio);
        $this->authorize('informacionMiPersonal', $user);
        $pdf = PDF::loadView('ninios.miParticipantes.pdf',['ninio'=>$user]);
        return $pdf->inline();
    }


    // A:Deivid
    // D:familia de ninio
    public function familia($idNinio)
    {
        $ninio=Ninio::findOrFail($idNinio);
        $this->authorize('informacionMiPersonal', $ninio);
    	$data = array('ninio' =>$ninio , );
    	return view('ninios.miParticipantes.familia',$data);
    }

    public function familiaGuardar(RqFamilia $request)
    {
        $ninio=Ninio::findOrFail($request->ninio);
        $this->authorize('informacionMiPersonal', $ninio);
        
        if($ninio->familia){ 
            $familia=Familia::findOrFail($ninio->familia->id);
            $familia->actualizadoPor=Auth::id();
            $request->session()->flash('success','Familia actualizada de '. $ninio->nombres);
        
        }else{
            $familia= new Familia();
            $familia->ninio_id=$ninio->id;        
            $familia->creadoPor=Auth::id();
            $request->session()->flash('success','Familia creada de '. $ninio->nombres);
        }

        $familia->papa=$request->papa;
        $familia->mama=$request->mama;
        // $familia->hermano1=$request->hermano1;
        // $familia->hermano2=$request->hermano2;
        // $familia->hermano3=$request->hermano3;
        // $familia->hermano4=$request->hermano4;
        // $familia->hermano5=$request->hermano5;
        // $familia->hermano6=$request->hermano6;
        // $familia->hermano7=$request->hermano7;
        // $familia->hermano8=$request->hermano8;
        // $familia->abuelo=$request->abuelo;
        // $familia->abuela=$request->abuela;
        // $familia->tio=$request->tio;
        // $familia->cunado=$request->cunado;
        // $familia->sobrino=$request->sobrino;
        /**este campo para el nombre del representante */
        $familia->otro1=$request->otro1;
        /**este campo para el nombre del celular */
        $familia->otro2=$request->otro2;
        /**este campo para el nombre del email */
        $familia->otro3=$request->otro3;
        // $familia->maestro=$request->maestro;
        $familia->save();
        return redirect()->route('familiaMiParticipante',$ninio->id);
    }
    //A:Fabian
    //D:Generar codigo Qr de niño
    public function qr($idNinio)
    {
        $ninio=Ninio::findOrFail($idNinio);
        $this->authorize('actualizarMiPersonal', $ninio);
        $pdf = PDF::setPaper('a6')->loadView('ninios.qr', ['ninio'=>$ninio]);
        return $pdf->inline();
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
                $this->authorize('verificarComunidadNinio', $ninio); 
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
    if($validatedData){
    $user=Ninio::findOrFail(Crypt::decryptString($request->getip));
    $this->authorize('verificarComunidadNinio', $user); 
    $num = 0;
    $num = $request->getid;
    $tipoArchivo=TipoArchivo::findOrFail($num);
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
        $this->authorize('verificarComunidadNinio', $user); 
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
      $this->authorize('verificarComunidadNinio', $carpeta->ninio); 
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

    public function buzon($idNinio)
    {
      $ninio=Ninio::findOrFail($idNinio);
      $this->authorize('informacionMiPersonal', $ninio);
      $buzones=$ninio->buzones()->paginate(10);
    	$data = array('ninio' =>$ninio ,'buzones'=>$buzones );
    	return view('ninios.miParticipantes.buzon.buzon',$data);
    }
    public function nuevoBuzonParticipante($idNinio)
    {
      $ninio=Ninio::findOrFail($idNinio);
      $this->authorize('informacionMiPersonal', $ninio);
      $cartaHoy=$ninio->cartasHoy()->first();
      $tipoCartas=TipoCarta::get(['id','nombre','imagen','imagenes','letras','archivo']);
      if ($cartaHoy) {
        $total=$cartaHoy->buzonCartas()->get();
     
        $tipoCartas=TipoCarta::whereNotIn('id',$total->pluck('id'))->get();
     }
   
      $data = array('ninio' =>$ninio ,'tipoCartas'=>$tipoCartas,'cartasHoy'=>$cartaHoy );
      return view('ninios.miParticipantes.buzon.crear',  $data);
    }
    public function crearCartasNuevo(Request $request)
    {
      if ($request->ajax()) {

        try {
                $idNinio=Crypt::decryptString($request->getIp);
                $idTipoCarta=Crypt::decryptString($request->getTi);
                $ninio=Ninio::findOrFail($idNinio);
                $this->authorize('verificarComunidadNinio', $ninio);
                $diaHoy=Carbon::now();
                $cartaHoy=$ninio->cartasHoy()->first();
                if ($cartaHoy) {
                  if($cartaHoy->estado=="Creada"){
                  $buzonCarta=new BuzonCarta();
                  $buzonCarta->buzon_id=$cartaHoy->id;
                  $buzonCarta->tipo_cartas_id=$idTipoCarta;
                  $buzonCarta->save();
                  return response()->json(['ok'=>  $ninio]);
                  }else{
                    return response()->json(['msj'=>"¡Advertencia!  No puede crear mas cartas en esta fecha ya que está en estado. Enviado"]);

                  }
                  
               }else{
                 $buzon=new Buzon();
                 $buzon->ninio_id=$ninio->id;
                 $buzon->fecha=$diaHoy;
                 $buzon->save();
                 $buzonCarta=new BuzonCarta();
                  $buzonCarta->buzon_id=$buzon->id;
                  $buzonCarta->tipo_cartas_id=$idTipoCarta;
                  $buzonCarta->save();
                  return response()->json(['ok'=>  $ninio]);
               }               
                                  
                
              } catch (DecryptException $e) {
                return response()->json(['msj'=>"Los datos ingresados son incorrectos"]);
            }
        }else{
          return response()->json(['msj'=>"Los datos ingresados son incorrectos"]);
      }
    }
    public function buscarCartasNuevo(Request $request)
    {
      if ($request->ajax()) {

        try {
                $idNinio=Crypt::decryptString($request->getIp);
                
                $ninio=Ninio::findOrFail($idNinio);
                $this->authorize('verificarComunidadNinio', $ninio); 
                $cartaHoy=$ninio->cartasHoy()->first();
                if ($cartaHoy) {
                  $todas=$cartaHoy->buzonCartas()->get();
                  return response()->json(['ok'=>  $ninio,'cartasHoy'=>$todas,'idBuzon'=>Crypt::encryptString($cartaHoy->id),'buzon'=>$cartaHoy->estado]);
               }else{
                $todas1="";
                return response()->json(['ok'=>  $ninio,'cartasHoy'=>$todas1]);
               }              
              } catch (DecryptException $e) {
                return response()->json(['msj'=>"Los datos ingresados son incorrectos"]);
            }
        }else{
          return response()->json(['msj'=>"Los datos ingresados son incorrectos"]);
      }
    }
  
    public function actualizarBoleta(Request $request)
    {
      $validatedData = $request->validate([
        'imagen' => 'required|mimes:jpg,jpeg,png',
        'getip'=>'required',
       ]);
        if($validatedData){
        $buzonCarta=BuzonCarta::findOrFail($request->getip);
        $user=Ninio::findOrFail($buzonCarta->buzon->ninio_id);
        $this->authorize('verificarComunidadNinio', $user);
        if($buzonCarta->buzon->estado!="Respondida"){ 
          if ($request->hasFile('imagen') ) {
            if ($request->file('imagen')->isValid()) {                
                $buzonCartaBoleta=new BuzonCartaBoleta();
                $archivo=$buzonCarta->buzon->fecha.'_'.$user->nombres.'_'.rand(0,20).'.'.$request->imagen->extension();
                $path = $request->imagen->storeAs('boletas', $archivo,'public');
                $buzonCartaBoleta->boleta=$archivo;                
                $buzonCartaBoleta->buzon_cartas_id=$buzonCarta->id;
                $buzonCartaBoleta->save();    
  
                return response()->json(['ok'=>'Boleta registrada exitosamente'] );
              }else{
                  return response()->json(['error'=>'No se puede subir el archivo ff']);
              }
            
            }else{
                return response()->json(['error'=>'No se puede subir el archivo']);
            }
          }else{
            return response()->json(['error'=>'Recuerde que solo puede actualizar la carta  antes de ser respondia ']);
          }
        }else{
          return response()->json(['error'=>'No se puede subir el archivo']);
      }
       
    }
    public function buscarBoleta(Request $request)
    {
      $validatedData = $request->validate([       
        'getIp'=>'required',
       ]);
        if($validatedData){
          $buzonCarta=BuzonCarta::findOrFail($request->getIp);
          $user=Ninio::findOrFail($buzonCarta->buzon->ninio_id);
          $this->authorize('verificarComunidadNinio', $user);
          $buzonCartaBoleta=$buzonCarta->buzonCartaBoletas;
          return response()->json(['ok'=>$buzonCartaBoleta]);      
        }else{
          return response()->json(['error'=>'No se puede subir el archivo']);
      }
       
    }
    public function actualizarRchivoCarta(Request $request)
    {
      $validatedData = $request->validate([
        'archivo' => 'required|mimes:pdf|max:50000',        
        'getip'=>'required'
      ]);
      if($validatedData){
        $buzonCarta=BuzonCarta::findOrFail($request->getip);
        $user=Ninio::findOrFail($buzonCarta->buzon->ninio_id);
        $this->authorize('verificarComunidadNinio', $user);
        if($buzonCarta->buzon->estado!="Respondida"){ 
          if ($request->hasFile('archivo') ) {
              if ($request->file('archivo')->isValid()) {                
                if($buzonCarta->archivo){            
                  Storage::disk('public')->delete('cartas/'.$buzonCarta->archivo);
                }

                  $archivo=$user->nombres.'_'.rand(0,20).'.'.$request->archivo->extension();
                  $path = $request->archivo->storeAs('cartas', $archivo,'public');
                  $buzonCarta->archivo=$archivo;                
                  
                  $buzonCarta->save();
                  $preview = Storage::url('public/cartas/'.$buzonCarta->archivo);
    
                  return response()->json(
                    [
                      'initialCaption'=>$buzonCarta->archivo,
                      'initialPreview' => $preview ,
                      'initialPreviewConfig' => [
                          // pass exif object below for `autoOrientImageInitial` detection 
                          // it must contain the `Orientation` property
                          ['type'=>'pdf','caption' => $buzonCarta->tipoCarta->nombre.' '.'carta', 'url' => route('eliminarCartapdf'), 'key' => $buzonCarta->id] 
                          
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
            return response()->json(['error'=>'Recuerde que solo puede actualizar la carta  antes de ser respondia ']);
          }
        }else{
          return response()->json(['error'=>'No se puede subir el archivo']);
      }
        
  }
  function eliminarBoleta (Request $request){
    $validatedData = $request->validate([   
      'key'=>'required'
    ]);
      if($validatedData){
          $buzonCartaBoleta=BuzonCartaBoleta::findOrFail($request->key);
          $buzonCarta=$buzonCartaBoleta->buzonCarta->id;
          $user=Ninio::findOrFail($buzonCartaBoleta->buzonCarta->buzon->ninio_id);
          $this->authorize('verificarComunidadNinio', $user); 
          if($buzonCartaBoleta->buzonCarta->estado!="Entregada"){ 
            Storage::disk('public')->delete('boletas/'.$buzonCartaBoleta->boleta);
          
            $buzonCartaBoleta->delete();
            return response()->json(['ok'=>$buzonCarta]);
            }else{
              return response()->json(['error'=>'Recuerde que solo puede eliminar la imágen solo en estdo  creada ']);
            }
          }else{
            return response()->json(['error'=>'No se puede subir el archivo']);
        }
      }
  function eliminarCartaPdf (Request $request)
  {
    $validatedData = $request->validate([   
      'key'=>'required'
    ]);
    if($validatedData){
      $buzonCarta=BuzonCarta::findOrFail($request->key);
      $user=Ninio::findOrFail($buzonCarta->buzon->ninio_id);          
      $this->authorize('verificarComunidadNinio', $user); 
      if($buzonCarta->buzon->estado=="Creada"){ 
            Storage::disk('public')->delete('cartas/'.$buzonCarta->archivo);
            $buzonCarta->archivo=null;
            $buzonCarta->save();
            return response()->json(
                [
                  'initialCaption'=>"",
                  'initialPreview' =>"" ,
                  'initialPreviewConfig' => [
                    // pass exif object below for `autoOrientImageInitial` detection 
                    // it must contain the `Orientation` property
                      
                  ]
                ]
                );
        }else{
          return response()->json(['error'=>'Recuerde que solo puede eliminar el pdf solo en estdo  creada ']);
        }
      }else{
        return response()->json(['error'=>'No se puede subir el archivo']);
    }
  }

  public function enviarCarta(Request $request)
    {
        $validatedData = $request->validate([                 
          'geti'=>'required'
        ]);
          if($validatedData){
            $idBuzon=Crypt::decryptString($request->geti);
            $buzon=Buzon::findOrFail($idBuzon);            
            $user=Ninio::findOrFail($buzon->ninio_id);
            $this->authorize('verificarComunidadNinio', $user);        

          if ($this->verificarExistencia($idBuzon)==0 ) {                         
              $buzon->estado="Enviada";
              $buzon->save();
                
              $this->envioCorreos($user,$buzon);
              return response()->json(['esb'=>$buzon->estado]);
             
          }else{
              return response()->json(['error'=>'No se puede enviar las cartas, verifique '.$this->verificarExistencia($idBuzon).' no  tienen imágenes o carta en pdf']);
          }
        }else{
          return response()->json(['error'=>'No se puede cambiar de estado verifique los datos de ingrese y vuelva ha intentar']);
      }
    }
    public function verificarExistencia($idbuzon)
    {
      $buzon=Buzon::findOrFail($idbuzon);
      $todas=$buzon->buzonCartas()->get();
      $gh=BuzonCartaBoleta::get();
      $buzonCartaBoletas=$todas->whereNotIn('cartasBuzon.id',$gh->pluck('buzon_cartas_id'))->count();
      $contador=0;
     if($buzonCartaBoletas>0){
      $contador=$contador+$buzonCartaBoletas;
     }
      foreach ($todas as $t) {
      
        if($t->nombre=="Contestación" && !$t->cartasBuzon->archivo ){
          $contador++;
        }
      }
      return $contador;
    }


    public function envioCorreos($user,$buzon)
    {
      if($user->email){
        $usuario1= new User([
            'name' => $user->nombre  ,
            'email' =>$user->email ,                
        ]);
        
        $usuario1->notify(new NotificacionEnvioCartas($buzon));
      }

      if($user->familia->otro3){
        $usuario= new User([
            'name' => $user->familia->otro1,
            'email' => $user->familia->otro3,                
        ]);
        $usuario->notify(new NotificacionEnvioCartas($buzon));
      }

      $msg_was='Estimadx Niñx '.$buzon->ninio->nombres. ' Ingresa al link tienes cartas que revisar. '. route('entrada',$buzon->ninio->token);
      
      // enviar por watsapp al representante
      if($user->familia->otro2){
          $this->enviarMensajeWhastApp($user->familia->otro2,$msg_was);
      }

      // enviar por wastapp al niño
      if($user->celular){
        $this->enviarMensajeWhastApp($user->celular,$msg_was);
      }

    }

    public function enviarMensajeWhastApp($numero,$mensaje)
    {
      $ULTRAMSG_API_URL=config('chatapi.ULTRAMSG_API_URL');
      $ULTRAMSG_API_ID=config('chatapi.ULTRAMSG_API_ID');
      $ULTRAMSG_API_TOKEN=config('chatapi.ULTRAMSG_API_TOKEN');
    
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $ULTRAMSG_API_URL.$ULTRAMSG_API_ID."/messages/chat",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "token=".$ULTRAMSG_API_TOKEN."&to="+$numero+"&body=".$mensaje."&priority=1&referenceId=",
        CURLOPT_HTTPHEADER => array(
          "content-type: application/x-www-form-urlencoded"
        ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
        return false;
      } else {
        return true;
      }

    }
    

    function eliminarCartaTotal (Request $request){
      $validatedData = $request->validate([   
        'geti'=>'required'
      ]);
        if($validatedData){
          $buzonCarta=BuzonCarta::findOrFail($request->geti);
          $buzonTipo=$buzonCarta->tipo_cartas_id;
          $buzon=Buzon::findOrFail($buzonCarta->buzon->id);
          $buzonTipoNombre=$buzonCarta->tipoCarta->nombre;
          $user=Ninio::findOrFail($buzonCarta->buzon->ninio_id);          
          $this->authorize('verificarComunidadNinio', $user); 
          if($buzonCarta->buzon->estado=="Creada"){ 
            if($buzonCarta->archivo){
              Storage::disk('public')->delete('cartas/'.$buzonCarta->archivo);
            }
            foreach ($buzonCarta->buzonCartaBoletas as $buzonCartaBoleta) {
              Storage::disk('public')->delete('boletas/'.$buzonCartaBoleta->boleta);
              $buzonCartaBoleta->delete();
            }          
                       
              $buzonCarta->delete();
              if($buzon->buzonCartas->count()==0){
                $buzon->delete();
                return response()->json(['ti'=>$buzonTipo,'bt'=>'si','tica'=>Crypt::encryptString($buzonTipo),'tino'=>$buzonTipoNombre,'enn'=>Crypt::encryptString($user->id)]);
              }
              return response()->json(['ti'=>$buzonTipo,'bt'=>'no','tica'=>Crypt::encryptString($buzonTipo),'tino'=>$buzonTipoNombre,'enn'=>Crypt::encryptString($user->id)]);
               
          }else{
            return response()->json(['error'=>'Recuerde que solo puede eliminar la carta en estdo  creada ']);
          }
        }else{
          return response()->json(['error'=>'No se puede subir el archivo']);
      }
    }
    public function vistaCarta($idCartaBuzon)
    {
      try {
        $idBuzon=Crypt::decryptString($idCartaBuzon);
        $buzonCarta=BuzonCarta::findOrFail($idBuzon);
        $buzonTipo=$buzonCarta->tipo_cartas_id;
        $buzonTipoNombre=$buzonCarta->tipoCarta->nombre;
        $user=Ninio::findOrFail($buzonCarta->buzon->ninio_id);          
        $this->authorize('verificarComunidadNinio', $user); 
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
  public function buscarMensajes(Request $request)
  {
    $ninio=Ninio::findOrFail($request->getIp);
    $this->authorize('actualizarMiPersonal', $ninio);
    $mensajes=$ninio->mensajesNinio;
    if($ninio){
      return response()->json(['mensajes'=>$mensajes]);
    }else{
      return response()->json(['noexi'=>'No existen datos']);
      
    }

  }

}