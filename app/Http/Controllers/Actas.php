<?php

namespace cactu\Http\Controllers;

use cactu\Models\Acta;
use cactu\Models\CuentaContable;
use cactu\Models\CuentaContableMesMaterial;
use cactu\Models\Material;
use cactu\Models\Mes;
use cactu\Models\Planificacion;
use cactu\Models\Poa\Poa;
use cactu\Models\Poa\PoaCuentas\CuentaContablePoaCuenta;

use cactu\Models\Poa\PoaCuentas\PoaContable;
use cactu\Models\Poa\PoaCuentas\PoaCuentaContableMes;
use cactu\Notifications\NotificarActa;
use cactu\Notifications\NotificarActaAceptada;
use cactu\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class Actas extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
      //A: Fabian Lopez   
    //D: Nuevas modificaciones en el modulo de planificaciones 
    public function buscarActividadesMateriales($IdPlanifica)
    {
        $this->authorize('G. de acta entrega recepción');
        $planificacion=Planificacion::findOrFail($IdPlanifica);
  
        //metodos para determinar cuantas pas con materiales existe
        $cuentacontable=CuentaContable::where('nombre','Materiales')->get();
        $cuentacontableCuentaPoa=CuentaContablePoaCuenta::whereIn('cuentaContable_id',$cuentacontable->pluck('id'))->get();
        $poaCuetaContable=PoaContable::whereIn('id',$cuentacontableCuentaPoa->pluck('poaContable_id'))->get();
        $planificacionPoa=$planificacion->poas->whereIn('id',$poaCuetaContable->pluck('poa_id'));        
        $poaCuetaContableExiste=PoaContable::whereIn('poa_id',$planificacionPoa->pluck('id'))->get();
        $cuentacontableCuentaPoaExistentes=CuentaContablePoaCuenta::whereIn('cuentaContable_id',$poaCuetaContableExiste->pluck('id'))
        ->whereIn('cuentaContable_id',$cuentacontable->pluck('id'))->get();
        $cuentacontableMes=PoaCuentaContableMes::whereIn('cuentaContablePoaCuenta_id',$cuentacontableCuentaPoaExistentes->pluck('id'))->get();
               
        $data = array('poas' =>$planificacionPoa,'cuentacontableMes'=>$cuentacontableMes,'planificacion'=> $planificacion);
    	return view('planificaciones.actas.index',$data);

    }
    public function acta($id)
    {

        $poaCuentaContableMes=PoaCuentaContableMes::findOrFail($id);
        $this->authorize('G. de acta entrega recepción');
        $this->authorize('verificarMesExistentePoaContable', $poaCuentaContableMes);
        $participantes= $poaCuentaContableMes->cuentaContablePoaCuenta->poaContable->poa->poaParticipante->comunidadPoaParticipantes;
        $materiales=Material::get();
        return view('planificaciones.actas.nueva',['poaCuentaCOntable'=>$poaCuentaContableMes,'participantes'=>$participantes,'materiales'=>$materiales]);
    }
    public function buscarLikeMateriales(Request $request)
    {
       //consultar       
       $acta=Acta::where('poaCuentaContableMes_id',$request->idMes)
       ->where('comunidadPoaParticipante_id',$request->idComunidad)->first();
       if($acta){
           $materialesExistentes=Material::whereNotIn('id',$acta->listadoMateriales->pluck('material_id'))->orderBy('nombre','asc')->get();
            return response()->json($materialesExistentes);
       }else{
           $materiales=Material::orderBy('nombre','asc')->get();
            return response()->json($materiales);
       }
        
    }
    public function guardarActasMateriales(Request $request)
    {
        $this->authorize('G. de acta entrega recepción');
        try {
            $request->validate([
                'poaMes' => 'required|exists:poaCuentaContableMes,id',
                'comunidadPoa' => 'required|exists:comunidadPoaParticipante,id',
                'gestor'=> 'required|exists:users,id',
                'matrial'=>'required|exists:materials,id',
            ]);
            $consultaActa=Acta::where('poaCuentaContableMes_id',$request->poaMes)->where('comunidadPoaParticipante_id',$request->comunidadPoa)->first();
            $material=Material::findOrFail($request->matrial);
            if($consultaActa){
                if($consultaActa->estado != "Aceptada"){ 
                    $consultaActaMateriales=CuentaContableMesMaterial::where('acta_id',$consultaActa->id)->where('material_id',$material->id)->count();
                    if($consultaActaMateriales>0){
                        return response()->json("repetido");
                    }else{                 
                        $cuentaMaterial=new CuentaContableMesMaterial();                
                        $cuentaMaterial->material_id=$material->id;
                        $cuentaMaterial->precio=$material->precio;
                        $cuentaMaterial->iva=$material->iva;
                        $cuentaMaterial->cantidad=$request->cantidad;
                        $cuentaMaterial->acta_id=$consultaActa->id;                
                        $cuentaMaterial->save();
                        return response()->json("ok");
                    }
                }
            }else{

                $acta=new Acta();
                $acta->poaCuentaContableMes_id=$request->poaMes;             
                $acta->comunidadPoaParticipante_id=$request->comunidadPoa;
                $acta->user_id=$request->gestor;
                $acta->creadoPor=Auth::id();
                $acta->save();                
                $cuentaMaterial=new CuentaContableMesMaterial();                
                $cuentaMaterial->material_id=$material->id;
                $cuentaMaterial->precio=$material->precio;
                $cuentaMaterial->iva=$material->iva;
                $cuentaMaterial->cantidad=$request->cantidad;
                $cuentaMaterial->acta_id=$acta->id;                
                $cuentaMaterial->save();
                
                return response()->json("ok");
            }
        } catch (\Throwable $th) {
            return response()->json("error");
        }
    }
    public function listaMateriales($idMes,$idComunidad)
    {
        $this->authorize('G. de acta entrega recepción');
        $consultaActa=Acta::where('poaCuentaContableMes_id',$idMes)->where('comunidadPoaParticipante_id',$idComunidad)->first();
        $aseguramiento=User::role('ASEGURAMIENTO-CACTU')->first();
        $presidente=User::role('PRESIDENTX-CACTU')->first();
        return view('planificaciones.actas.listado',['consultaActa'=>$consultaActa,'aseguramiento'=>$aseguramiento,'presidente'=>$presidente]);
    }
    public function borrarActaMaerial(Request $request)
    {
        $this->authorize('G. de acta entrega recepción');
        $request->validate([
            'actaMes'=>'required|exists:cuenta_contable_mes_materials,id',
        ]);

        try {
            DB::beginTransaction();
            $modulo=CuentaContableMesMaterial::findOrFail($request->actaMes);
            $modulo->delete();
            DB::commit();
            return response()->json(['success'=>'Material del acta eliminado']);

        } catch (\Exception $th) {
            DB::rollBack();
            return response()->json(['default'=>'No se puede eliminar el material del acta']);
        }
    }

    public function cambiarEstadoActa(Request $request)
    {
        $this->authorize('G. de acta entrega recepción');
        $request->validate([
            'acta'=>'required|exists:actas,id',
        ]);

        try {
            DB::beginTransaction();
            $acta=Acta::findOrFail($request->acta);
            $acta->estado="Entregada";
            $acta->save();
            $usuario=$acta->comunidadActa->comunidad->usuario;
            $usuario->notify(new NotificarActa($acta));
            DB::commit();
            return response()->json(['success'=>'El acta fue entrgada exitosamente a su gestor']);

        } catch (\Exception $th) {
            DB::rollBack();
            return response()->json(['default'=>'No se puede entrear el acta'.$th]);
        }
    }
  
    public function miActa($idActa)
    {  
            
        $acta=Acta::findOrFail($idActa);
        $this->authorize('verActa',$acta);
        $aseguramiento=User::role('ASEGURAMIENTO-CACTU')->first();
        $presidente=User::role('PRESIDENTX-CACTU')->first();
        return view('planificaciones.actas.respaldo',['acta'=>$acta,'aseguramiento'=>$aseguramiento,'presidente'=>$presidente]);
    }
    public function cambiarEstadoActaAceptada(Request $request)
    {
        $request->validate([
            'acta'=>'required|exists:actas,id',
        ]);

        try {
            DB::beginTransaction();
            $acta=Acta::findOrFail($request->acta);
            $this->authorize('verActa',$acta);
            $acta->estado="Aceptada";
            $acta->user_id=Auth::id();
            $acta->save();
            $usuario= new User([
                'name' => 'Santiago',
                'email' => 'appcactu2020@gmail.com',                
            ]);
            
            $usuario->notify(new NotificarActaAceptada($acta));
            DB::commit();
            
            $request->session()->flash('success', 'El acta fue aceptada exitosamente ');

        } catch (\Exception $th) {
            DB::rollBack();
            
            $request->session()->flash('default', 'No se puede se aceptada el acta'.$th);
        }
        return response()->json(['default'=>'No se puede entrear el acta']);
        
    }
    public function terminos()
    {
        return view('planificaciones.actas.terminosCondiciones');

    }
    public function exportarActa($idActa)
    {
        $acta=Acta::findOrFail($idActa);
        $aseguramiento=User::role('ASEGURAMIENTO-CACTU')->first();
        $presidente=User::role('PRESIDENTX-CACTU')->first();
        $pdf = Pdf::loadView('planificaciones.actas.pdfActas', ['consultaActa'=>$acta,'aseguramiento'=>$aseguramiento,'presidente'=>$presidente]);
        //return $pdf->inline();
        return $pdf->download('acta-'.$acta->comunidadActa->comunidad->nombre.'-'.$acta->poaCuentaContableMes->mes->mes.'.pdf');
         
    }
}
