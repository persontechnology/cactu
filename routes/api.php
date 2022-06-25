<?php

use cactu\Models\Buzon\BuzonCarta;
use cactu\Models\Familia;
use cactu\Models\Ninio;
use cactu\Models\Buzon\Buzon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Carbon\Carbon;


Route::post('/login',function(Request $request){
    $request->validate([
        'numero_child' => 'required|string|max:255'
    ]);    

    $ninio = Ninio::where('numeroChild', $request->numero_child)->first();

    if (!$ninio) {
        throw ValidationException::withMessages(['Número clild no se encuentra en nuestro sistema']);
    }
    
    $tk=$ninio->createToken($ninio->numeroChild)->plainTextToken;
    
    $data = array(
        'message'=>'ok',
        'id'=>$ninio->id,
        'numero_child' => $ninio->numeroChild,
        'nombres'=>$ninio->nombres,
        'token'=>$tk,
        'roles_permisos'=>[]
    );
    return response()->json($data);
});


Route::middleware(['auth:sanctum'])->group(function () {
    
    // listar vartas de niños
    Route::post('/listar-mis-cartas',function(Request $request){
        $ninio=Ninio::find($request->userId);
        $buzoncartas=$ninio->buzonCartasNinioDirecto()
        // ->where('buzon_cartas.estado','!=','Respondida')
        // ->orWhere('buzon_cartas.estado','Enviada')
        ->orderBy('created_at','desc')
        ->get();
        
        $data= array();
        foreach ($buzoncartas as $bc) {
            
            array_push($data,[
                'archivo'=>$bc->archivo,
                'buzon_id'=>$bc->buzon_id,
                'created_at'=>$bc->fecha_m,
                'estado'=>$bc->estado,
                'id'=>$bc->id,
                'imagen'=>$bc->imagen,
                'imagen2'=>$bc->imagen2,
                'respuesta'=>$bc->respuesta,
                'tipo_cartas_id'=>$bc->tipo_cartas_id,
                'updated_at'=>$bc->updated_at,
                'tipo_carta_nombre'=>$bc->tipoCarta->nombre,
                'edad'=>Carbon::parse($bc->buzon->ninio->fechaNacimiento)->age??0
            ]);  
            
        }
       
        return response()->json(['data'=>$data]);
    });


    // guardar presentacion
    Route::post('/responder-presentacion-mayores',function(Request $request)
    {
        
      $request->validate([
        'userId'=>'required',
        'buzonCartaId'=>'required',
        'op'=>'required',
        'hola'=>'required|string|max:255|min:2',
        'soy'=>'required|string|max:255|min:2',
        'meDicen'=>'required|string|max:255|min:2',
        'edad'=>'required|string|max:255|min:2',
        'miMejorAmigo'=>'required|string|max:255|min:2',
        'esMejorAmigo'=>'required|string|max:255|min:2',
        'loquehago'=>'required|string|max:255|min:2',
        'miSueno'=>'required|string|max:255|min:2',
        'dondeAprendo'=>'required|string|max:255|min:2',
        'gustaAprendes'=>'required|string|max:255|min:2',
        'mePaso'=>'required|string|max:255|min:2',
        'meGustaria'=>'required|string|max:255|min:2',
        'miFamilia'=>'required|string|max:255|min:2',
        'nuestraPro'=>'required|string|max:255|min:2',
        'idioma'=>'required|string|max:255|min:2',
        'lugarFavorito'=>'required|string|max:255|min:2',
        'comidaTipica'=>'required|string|max:255|min:2',
        'comer'=>'required|string|max:255|min:2',
        'masMeGusta'=>'required|string|max:255|min:2',
        'pregunta'=>'required|string|max:255|min:2',
        'despedida'=>'required|string|max:255|min:2',
      ]);

        try {
            // $idCartade=Crypt::decryptString($request->getIp);
            // $idniniode=Crypt::decryptString($request->token);
            $op=$request->op;

            $ninio=Ninio::find($request->userId);
            $buzonCarta=BuzonCarta::find($request->buzonCartaId); //->with('buzon')->with('tipoCarta')->first();
            
            $buzon=Buzon::where('ninio_id',$ninio->id)->where('id',$buzonCarta->buzon->id)->first();  
            
            $diaHoy=Carbon::now();
            

            $buzones=$buzon->buzonCartasNinio()->where('estado','!=','Respondida')->wherePivot('id','!=',$buzonCarta->id)->get(); 
            

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

            // if($buzonCarta->buzon->estado=='Respondida' || $buzonCarta->estado=='Respondida'){
            //     return response()->json(['info'=>'Carta ya fue respondida']);
            // }else{
            //     if ($request->hasFile('fotoPersonal') && $request->hasFile('fotoFamiliar')) {
            //         if ($request->file('fotoPersonal')->isValid() && $request->file('fotoFamiliar')->isValid()) {
                        
            //             $imagePersonal = $buzonCarta->id.'.'.$request->fotoPersonal->extension();  
            //             $imageFamiliar = $buzonCarta->id.'2.'.$request->fotoFamiliar->extension();
    
            //             $path=Storage::putFileAs('public/imagenNinio',$request->file('fotoPersonal'),$imagePersonal);
            //             $path2=Storage::putFileAs('public/imagenNinio',$request->file('fotoFamiliar'),$imageFamiliar);
            //             $urlPersonal = Storage::url("public/imagenNinio/".$imagePersonal);
            //             $urlFamiliar = Storage::url("public/imagenNinio/".$imageFamiliar);
            //             $buzonCarta->imagen=$urlPersonal;
            //             $buzonCarta->imagen2=$urlFamiliar;   
            //             $buzonCarta->respuesta=$respuesta;
            //             $buzonCarta->estado="Respondida";
            //             $buzonCarta->save();
                        
            //             if(!$buzones->count()>0){
            //                 $buzon->estado="Respondida";
            //                 $buzon->save(); 
            //             }
            //             return response()->json(['success'=>'Carta resgitrado exitosamente']);
            //         }
            //     }
            // }
            return response()->json('ok');
        } catch (DecryptException $e) {
            return response()->json('false');
        }
       
    });



});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return User::all();
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
