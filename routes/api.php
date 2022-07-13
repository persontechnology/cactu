<?php

use cactu\Models\Buzon\BuzonCarta;
use cactu\Models\Familia;
use cactu\Models\Ninio;
use cactu\Models\Buzon\Buzon;
use cactu\Models\Buzon\MensajeNinio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

Route::post('/login', function (Request $request) {
    try {
        $request->validate([
            'numero_child' => 'required|string|max:255'
        ]);

        $ninio = Ninio::where('numeroChild', $request->numero_child)->first();

        if (!$ninio) {
            throw ValidationException::withMessages(['Número clild no se encuentra en nuestro sistema']);
        }

        $tk = $ninio->createToken($ninio->numeroChild)->plainTextToken;

        $data = array(
            'message' => 'ok',
            'id' => $ninio->id,
            'numero_child' => $ninio->numeroChild,
            'nombres' => $ninio->nombres,
            'token' => $tk,
            'roles_permisos' => []
        );
        return response()->json($data);
    } catch (\Throwable $th) {
        return response()->json($th);
    }
});


Route::middleware(['auth:sanctum'])->group(function () {

    // listar vartas de niños
    Route::post('/listar-mis-cartas', function (Request $request) {
        $ninio = Ninio::find($request->userId);
        $buzoncartas = $ninio->buzonCartasNinioDirecto()
            // ->where('buzon_cartas.estado','!=','Respondida')
            // ->orWhere('buzon_cartas.estado','Enviada')
            ->orderBy('created_at', 'desc')
            ->get();

        $data = array();
        foreach ($buzoncartas as $bc) {

            array_push($data, [
                'archivo' => Storage::disk('public')->exists('cartas/' . $bc->archivo)?url('/').Storage::url('cartas/' . $bc->archivo):'no',
                'buzon_id' => $bc->buzon_id,
                'created_at' => $bc->fecha_m,
                'estado' => $bc->estado,
                'id' => $bc->id,
                'imagen' => $bc->imagen,
                'imagen2' => $bc->imagen2,
                'respuesta' => $bc->respuesta,
                'tipo_cartas_id' => $bc->tipo_cartas_id,
                'updated_at' => $bc->updated_at,
                'tipo_carta_nombre' => $bc->tipoCarta->nombre,
                'edad' => Carbon::parse($bc->buzon->ninio->fechaNacimiento)->age ?? 0
            ]);
        }

        return response()->json(['data' => $data]);
    });


    // guardar presentacion
    Route::post('/responder-presentacion-mayores', function (Request $request) {
        
        $op = $request->op;

        if ($op == 'mayor') {
            
            $request->validate([
                'userId' => 'required',
                'buzonCartaId' => 'required',
                'op' => 'required',
                'hola' => 'required|string|max:255',
                'soy' => 'required|string|max:255',
                'meDicen' => 'required|string|max:255',
                'edad' => 'required|string|max:255',
                'miMejorAmigo' => 'required|string|max:255',
                'esMejorAmigo' => 'required|string|max:255',
                'loquehago' => 'required|string|max:255',
                'miSueno' => 'required|string|max:255',
                'dondeAprendo' => 'required|string|max:255',
                'gustaAprendes' => 'required|string|max:255',
                'mePaso' => 'required|string|max:255',
                'meGustaria' => 'required|string|max:255',
                'miFamilia' => 'required|string|max:255',
                'nuestraPro' => 'required|string|max:255',
                'idioma' => 'required|string|max:255',
                'lugarFavorito' => 'required|string|max:255',
                'comidaTipica' => 'required|string|max:255',
                'comer' => 'required|string|max:255',
                'masMeGusta' => 'required|string|max:255',
                'pregunta' => 'required|string|max:255',
                'despedida' => 'required|string|max:255',
            ]);
        } else {
            
            $request->validate([
                'hola' => 'required|string|max:255',
                'escribo' => 'required|string|max:255',
                'mi' => 'required|string|max:255',
                'queel' => 'required|string|max:255',
                'cumple' => 'required|string|max:255',
                'noSabe' => 'required|string|max:255',
                'ademas' => 'required|string|max:255',
                'leGusta' => 'required|string|max:255',
                'dondeAprendo' => 'required|string|max:255',
                'gustaAprendes' => 'required|string|max:255',
                'mePaso' => 'required|string|max:255',
                'meGustaria' => 'required|string|max:255',
                'miNombre' => 'required|string|max:255',
                'ysoy' => 'required|string|max:255',
                'de' => 'required|string|max:255',
                'mifamilia' => 'required|string|max:255',
                'nuestraPro' => 'required|string|max:255',
                'idioma' => 'required|string|max:255',
                'lugarFavorito' => 'required|string|max:255',
                'comidaTipica' => 'required|string|max:255',
                'ya' => 'required|string|max:255',
                'comer' => 'required|string|max:255',
                'masMeGusta' => 'required|string|max:255',
                'pregunta' => 'required|string|max:255',
                'despedida' => 'required|string|max:255',
            ]);
        }

        try {
            // $idCartade=Crypt::decryptString($request->getIp);
            // $idniniode=Crypt::decryptString($request->token);
           

            $ninio = Ninio::find($request->userId);
            $buzonCarta = BuzonCarta::find($request->buzonCartaId); //->with('buzon')->with('tipoCarta')->first();

            $buzon = Buzon::where('ninio_id', $ninio->id)->where('id', $buzonCarta->buzon->id)->first();

            $diaHoy = Carbon::now();


            $buzones = $buzon->buzonCartasNinio()->where('estado', '!=', 'Respondida')->wherePivot('id', '!=', $buzonCarta->id)->get();


            if ($op == "mayor") {

                $respuesta = $op . '\-' .
                    $diaHoy . '\-' .
                    $request->hola . '\-' .
                    $request->soy . '\-' .
                    $request->meDicen . '\-' .
                    $request->edad . '\-' .
                    $request->miMejorAmigo . '\-' .
                    $request->esMejorAmigo . '\-' .
                    $request->loquehago . '\-' .
                    $request->miSueno . '\-' .
                    $request->dondeAprendo . '\-' .
                    $request->gustaAprendes . '\-' .
                    $request->mePaso . '\-' .
                    $request->meGustaria . '\-' .
                    $request->miFamilia . '\-' .
                    $request->nuestraPro . '\-' .
                    $request->idioma . '\-' .
                    $request->lugarFavorito . '\-' .
                    $request->comidaTipica . '\-' .
                    $request->comer . '\-' .
                    $request->masMeGusta . '\-' .
                    $request->pregunta . '\-' .
                    $request->despedida;
            } else {
                $respuesta = $op . '\-' .
                    $diaHoy . '\-' .
                    $request->hola . '\-' .

                    $request->escribo . '\-' .
                    $request->mi . '\-' .
                    $request->queel . '\-' .
                    $request->cumple . '\-' .
                    $request->noSabe . '\-' .
                    $request->ademas . '\-' .
                    $request->leGusta . '\-' .

                    $request->dondeAprendo . '\-' .
                    $request->gustaAprendes . '\-' .
                    $request->mePaso . '\-' .
                    $request->meGustaria . '\-' .

                    $request->miNombre . '\-' .
                    $request->ysoy . '\-' .
                    $request->de . '\-' .
                    $request->mifamila . '\-' .

                    $request->nuestraPro . '\-' .
                    $request->idioma . '\-' .
                    $request->lugarFavorito . '\-' .
                    $request->comidaTipica . '\-' .

                    $request->ya . '\-' .
                    $request->comer . '\-' .
                    $request->masMeGusta . '\-' .
                    $request->pregunta . '\-' .
                    $request->despedida;
            }

            if ($buzonCarta->buzon->estado == 'Respondida' || $buzonCarta->estado == 'Respondida') {
                return response()->json(['info' => 'Carta ya fue respondida']);
            } else {
                if ($request->hasFile('fotoPersonal') && $request->hasFile('fotoFamiliar')) {
                    if ($request->file('fotoPersonal')->isValid() && $request->file('fotoFamiliar')->isValid()) {

                        $imagePersonal = $buzonCarta->id . '.' . $request->fotoPersonal->extension();
                        $imageFamiliar = $buzonCarta->id . '2.' . $request->fotoFamiliar->extension();

                        $path = Storage::putFileAs('public/imagenNinio', $request->file('fotoPersonal'), $imagePersonal);
                        $path2 = Storage::putFileAs('public/imagenNinio', $request->file('fotoFamiliar'), $imageFamiliar);
                        $urlPersonal = Storage::url("public/imagenNinio/" . $imagePersonal);
                        $urlFamiliar = Storage::url("public/imagenNinio/" . $imageFamiliar);
                        $buzonCarta->imagen = $urlPersonal;
                        $buzonCarta->imagen2 = $urlFamiliar;
                        $buzonCarta->respuesta = $respuesta;
                        $buzonCarta->estado = "Respondida";
                        $buzonCarta->save();

                        if (!$buzones->count() > 0) {
                            $buzon->estado = "Respondida";
                            $buzon->save();
                        }
                        return response()->json(['success' => 'Carta registrado exitosamente']);
                    }
                }
            }
            return response()->json('ok');
        } catch (\Throwable $th) {
            return response()->json('false');
        }
    });

    // otras cartas
    Route::post('/responder-otras-cartas', function(Request $request)
    {
        $validated = $request->validate([
            'foto' => 'required|image',
            'respuesta' => 'required|string|max:580|min:4',
        ]);

        try {
            

            $ninio = Ninio::find($request->userId);
            $buzonCarta = BuzonCarta::find($request->buzonCartaId);

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
                        $buzones=$buzon->buzonCartasNinio()->where('estado','!=','Respondida')->wherePivot('id','!=',$buzonCarta->id)->get(); 
                        if(!$buzones->count()>0){
                            $buzon->estado="Respondida";
                            $buzon->save(); 
                        }
                        return response()->json(['success'=>'Carta resgitrado exitosamente']);
                    }
                }
                return response()->json(['error'=>'Carta no registrado vuelva intentar']);
            }
        } catch (Throwable $e) {
            return response()->json(['error'=>'Ocurrio un error, vuelva intentar']);
        }
       
    });

    // guardar mensaje
    Route::post('/guardar-mensaje', function(Request $request)
    {
        
        $validated = $request->validate([
            'mensaje' => 'required|string|max:250',
            'userId'=>'required'
        ]);

        $diaHoy=Carbon::now();
        $ninio=Ninio::find($request->userId);
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
                return response()->json(['info'=>'Por hoy ya no puedes enviar mas mensajes.']); 
            }
        }else{
            return response()->json(['info'=>'Ocurrio un error, vuelva intentar.']); 
        }
    });
    // listar mis chats
    Route::post('/listar-mis-chats', function(Request $request)
    {
        
        $ninio=Ninio::find($request->userId);
        return response()->json($ninio->mensajesNinio()->latest()->get());
        
    });

    
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return User::all();
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
