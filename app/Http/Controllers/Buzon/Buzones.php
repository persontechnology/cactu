<?php

namespace cactu\Http\Controllers\Buzon;

use Illuminate\Http\Request;
use cactu\Http\Controllers\Controller;
use cactu\Models\Ninio;
use cactu\Models\Buzon\BuzonCarta;
use cactu\Models\Buzon\Buzon;
use cactu\Models\Buzon\MensajeNinio;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
class Buzones extends Controller
{
    public function index($token)
    {
        $ninio=Ninio::where('token',$token)->first();
        if($ninio){
            // ->where('estado','!=','Respondida')->where('estado','Enviada')
            $buzones=$ninio->buzones()->get();
            $data = array('ninio' =>$ninio,'buzones'=>$buzones);
            return view('cartas.index',$data);
            // return view('buzon.index',$data);
        }else{
            return abort(404);
        }
    }
    // public function buzon($token){
    //     $ninio=Ninio::where('token',$token)->first();
    //     if($ninio){
    //         $buzones=$ninio->buzones()->where('estado','!=','Respondida')->where('estado','Enviada')->get();
            
    //         $data = array('ninio' =>$ninio,'buzones'=>$buzones);
    //         return view('buzon.buzon',$data);

    //     }else{
    //         return abort(404);
    //     }
    // }
    public function respuestaCarta($idCarta,$token)
    {
        try {
            $idCartade=Crypt::decryptString($idCarta);
            $idniniode=Crypt::decryptString($token);
            $ninio=Ninio::where('token',$idniniode)->first();
            $buzonCarta=BuzonCarta::where('id',$idCartade)->with('buzon')->with('tipoCarta')->first();
            $buzon=Buzon::where('ninio_id',$ninio->id)->where('id',$buzonCarta->buzon->id)->first();         
            //     if($ninio && $buzonCarta && $buzon){
            //         if($buzonCarta->buzon->estado=='Respondida' || $buzonCarta->estado=='Respondida'){
            //             session()->flash('info','Recuerde esta carta ya fue respondida  '. $buzonCarta->tipoCarta->nombres);
            //             return redirect()->route('misCartasBuzon',$ninio->token);
            //         }else{

            //             $buzones=$buzon->buzonCartasNinio()->where('estado','!=','Respondida')->wherePivot('id','!=',$idCartade)->get();                        
            //             $data = array('ninio' =>$ninio,'buzones'=>$buzones,'buzonCarta'=> $buzonCarta);
            //             return view('buzon.respuesta.main',$data);
            //         }                  
            //     }else{
            //         return abort(404);
            // }
            // $buzones=$buzon->buzonCartasNinio()->where('estado','!=','Respondida')->wherePivot('id','!=',$idCartade)->get();                        
            $data = array('buzonCarta'=> $buzonCarta);
            
            return view('cartas.respuest',$data);
            // return view('buzon.respuesta.main',$data);
        } catch (DecryptException $e) {
            return abort(404);
        }
    
    }
    
    
    // public function guardarImagenUno(Request $request)
    // {
    //     $buzonCarta=BuzonCarta::findOrFail($request->getIp);
    //     if($request->numero==1){
        
    //           if ($request->hasFile('foto')) {
    //             if ($request->file('foto')->isValid()) {
    //                 $extension = $request->foto->extension();
    //                $imageName = $buzonCarta->id.'.'.$extension;  
    //                 $path = Storage::putFileAs(
    //                     'public/imagenNinio',$request->file('foto'),$buzonCarta->id.'.'.$extension
    //                 );
    //                 $buzonCarta->imagen=$path;
    //                 $buzonCarta->save();
    //                 $data_res = array('success' =>"Foto registrada exitosamente");
    //             }                  
    //         }else{
    //             $data_res = array('error' =>'No se puede registrar la imágen');
    //         }              
        
    //         return response()->json($data_res);
    //     }else{
            
    //         if ($request->hasFile('foto')) {
    //             if ($request->file('foto')->isValid()) {
    //                 $extension = $request->foto->extension();
    //                $imageName =$buzonCarta->id.'2'.'.'.$extension;  
    //                $path = Storage::putFileAs(
    //                     'public/imagenNinio',$request->file('foto'),$buzonCarta->id.'2'.'.'.$extension
    //                 );
    //                 $url = Storage::url("public/imagenNinio/".$imageName);
    //                   $buzonCarta->imagen2=$url;
    //                  $buzonCarta->save();
    //                 $data_res = array('success' =>"Foto registrada exitosamente");
    //             }                  
    //         }else{
    //             $data_res = array('error' =>'No se puede registrar la imágen');
    //         }      
        
    //         return response()->json($data_res);
    //     }
    // }


    public function responderPreMayores(Request $request)
    {
        
        $validated = $request->validate([
            'fotoPersonal' => 'required|image',
            'fotoFamiliar' => 'required|image',
        ]);
        try {
            $idCartade=Crypt::decryptString($request->getIp);
            $idniniode=Crypt::decryptString($request->token);
            $op=Crypt::decryptString($request->op);
            $ninio=Ninio::where('token',$idniniode)->first();
            $buzonCarta=BuzonCarta::where('id',$idCartade)->with('buzon')->with('tipoCarta')->first();
            $buzon=Buzon::where('ninio_id',$ninio->id)->where('id',$buzonCarta->buzon->id)->first();  
            $diaHoy=Carbon::now();

            $buzones=$buzon->buzonCartasNinio()->where('estado','!=','Respondida')->wherePivot('id','!=',$idCartade)->get(); 

            if($op=="mayor"){
                
                $respuesta=$op.'\-'.
                $diaHoy.'\-'.
                $request->hola.'\-'.
                $request->soy.'\-'.
                $request->meDicen.'\-'.
                $request->edad.'\-'.
                $request->miMejorAmigo.'\-'.
                $request->esMejorAmigo.'\-'.
                $request->loquehago.'\-'.
                $request->miSueno.'\-'.
                $request->dondeAprendo.'\-'.
                $request->gustaAprendes.'\-'.
                $request->mePaso.'\-'.
                $request->meGustaria.'\-'.
                $request->miFamilia.'\-'.
                $request->nuestraPro.'\-'.
                $request->idioma.'\-'.
                $request->lugarFavorito.'\-'.
                $request->comidaTipica.'\-'.
                $request->comer.'\-'.
                $request->masMeGusta.'\-'.
                $request->pregunta.'\-'.
                $request->despedida;
            }else{
                $respuesta=$op.'\-'.
                $diaHoy.'\-'.
                $request->hola.'\-'.
                
                $request->escribo.'\-'.
                $request->mi.'\-'.
                $request->queel.'\-'.
                $request->cumple.'\-'.
                $request->noSabe.'\-'.
                $request->ademas.'\-'.
                $request->leGusta.'\-'.
                
                $request->dondeAprendo.'\-'.
                $request->gustaAprendes.'\-'.
                $request->mePaso.'\-'.
                $request->meGustaria.'\-'.
                
                $request->miNombre.'\-'.
                $request->ysoy.'\-'.
                $request->de.'\-'.
                $request->mifamila.'\-'.
                
                $request->nuestraPro.'\-'.
                $request->idioma.'\-'.
                $request->lugarFavorito.'\-'.
                $request->comidaTipica.'\-'.
                
                $request->ya.'\-'.
                $request->comer.'\-'.
                $request->masMeGusta.'\-'.
                $request->pregunta.'\-'.
                $request->despedida;
            }
            if($buzonCarta->buzon->estado=='Respondida' || $buzonCarta->estado=='Respondida'){
                return response()->json(['info'=>'Carta ya fue respondida']);
            }else{
                if ($request->hasFile('fotoPersonal') && $request->hasFile('fotoFamiliar')) {
                    if ($request->file('fotoPersonal')->isValid() && $request->file('fotoFamiliar')->isValid()) {
                        
                        $imagePersonal = $buzonCarta->id.'.'.$request->fotoPersonal->extension();  
                        $imageFamiliar = $buzonCarta->id.'2.'.$request->fotoFamiliar->extension();
    
                        $path=Storage::putFileAs('public/imagenNinio',$request->file('fotoPersonal'),$imagePersonal);
                        $path2=Storage::putFileAs('public/imagenNinio',$request->file('fotoFamiliar'),$imageFamiliar);
                        $urlPersonal = Storage::url("public/imagenNinio/".$imagePersonal);
                        $urlFamiliar = Storage::url("public/imagenNinio/".$imageFamiliar);
                        $buzonCarta->imagen=$urlPersonal;
                        $buzonCarta->imagen2=$urlFamiliar;   
                        $buzonCarta->respuesta=$respuesta;
                        $buzonCarta->estado="Respondida";
                        $buzonCarta->save();
                        
                        if(!$buzones->count()>0){
                            $buzon->estado="Respondida";
                            $buzon->save(); 
                        }
                        return response()->json(['success'=>'Carta resgitrado exitosamente']);
                    }
                }
            }
            
        } catch (DecryptException $e) {
            return response()->json('false');
        }
       
    }
    public function responderOtrasCartas(Request $request)
    {
        $validated = $request->validate([
            'foto' => 'required|image',
            'respuesta' => 'required|string|max:580|min:400',
        ]);

        try {
            $idCartade=Crypt::decryptString($request->getIp);
            $idniniode=Crypt::decryptString($request->token);         
            $ninio=Ninio::where('token',$idniniode)->first();
            $buzonCarta=BuzonCarta::where('id',$idCartade)->with('buzon')->with('tipoCarta')->first();
            $buzon=Buzon::where('ninio_id',$ninio->id)->where('id',$buzonCarta->buzon->id)->first();  
            
            if($buzonCarta->buzon->estado=='Respondida' || $buzonCarta->estado=='Respondida'){
                return response()->json(['info'=>'Carta ya fue respondida']);
            }else{
                if ($request->hasFile('foto')) {
                    if ($request->file('foto')->isValid()) {
                        $extension = $request->foto->extension();
                        $imageName = $buzonCarta->id.'.'.$extension;  
                        $path=Storage::putFileAs('public/imagenNinio',$request->file('foto'),$imageName);
                        $url = Storage::url("public/imagenNinio/".$imageName);
                        $buzonCarta->imagen=$url;
                        $buzonCarta->respuesta=$request->respuesta;
                        $buzonCarta->estado="Respondida";        
                        $buzonCarta->save();
                        $buzones=$buzon->buzonCartasNinio()->where('estado','!=','Respondida')->wherePivot('id','!=',$idCartade)->get(); 
                        if(!$buzones->count()>0){
                            $buzon->estado="Respondida";
                            $buzon->save(); 
                        }
                        return response()->json(['success'=>'Carta resgitrado exitosamente']);
                    }
                }
                return response()->json(['info'=>'Carta no resgitrado vuelva intentar']);
            }
        } catch (DecryptException $e) {
            return response()->json(['info'=>'Ocurrio un error, vuelva intentar']);
        }
       
    }

    // public function buscarImagnes($idCartade)
    // {      
    //     $buzonCarta=BuzonCarta::where('id',$idCartade)->with('buzon')->with('tipoCarta')->first();
    //         if($buzonCarta->imagen && $buzonCarta->imagen2){
    //             return true;
    //         }else{
    //             return false;
    //         }
    
    // }


    // function primeraPosiscion($buzones){
    //     $count=0;
    //     $id;
    //     foreach($buzones as $bu){
    //         if($count==0){
    //             $id=$bu->cartasBuzon->id;
    //         }
    //     }
    //     return $id;
    // }

    public function guardarMesaje(Request $request)
    {
        $validated = $request->validate([
            'mensaje' => 'required|string|max:250',
        ]);

        $diaHoy=Carbon::now();
        $ninio=Ninio::where('token',$request->getIp)->first();
        if($ninio){
            $mesajefecha=MensajeNinio::where('ninio_id',$ninio->id)->whereDate('fecha',$diaHoy->toDateString());
            if( $mesajefecha->count()<2){
                $mesajeNinio=new MensajeNinio();
                $mesajeNinio->ninio_id=$ninio->id;
                $mesajeNinio->mensaje=$request->mensaje;
                $mesajeNinio->fecha=$diaHoy;
                $mesajeNinio->save();
                return response()->json(['success'=>'Tu mensaje fue enviado a nombre de: '.$ninio->nombres]);
            }else{
                return response()->json(['info'=>'Por hoy ya no puedes enviar mas mensajes']); 
            }
        }else{
            return response()->json(['info'=>'Ocurrio un error, vuelva intentar']); 
        }
    }
}
