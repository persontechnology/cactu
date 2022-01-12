<?php

namespace cactu\Http\Controllers\Poas;

use Illuminate\Http\Request;
use cactu\Http\Controllers\Controller;
use cactu\Http\Requests\Poa\RqPoaParticipanteValorMes;
use cactu\Models\Localidad\Comunidad;
use cactu\Models\Mes;
use cactu\Models\Poa\Poa;
use cactu\Models\Poa\PoaParticipantes\ComunidadPoaParticipante;
use cactu\Models\Poa\PoaParticipantes\PoaParticipante;
use cactu\Models\Poa\PoaParticipantes\PoaParticipanteMes;
use cactu\Models\TipoParticipante;
use cactu\Models\Usuario\Coordinador;
use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;

class PoaParticipantes extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role_or_permission:Administrador|G. de planificaciones']);
    }

    public function index($idPoa)
    {
        $poa=Poa::findOrFail($idPoa);

        $poaParticipante=$poa->poaParticipante;
        if(!$poaParticipante){
            $poaParticipante=new PoaParticipante();
            $poaParticipante->poa_id=$poa->id;
            $poaParticipante->save();
        }
        
        $this->actualizarMeses($poaParticipante);

        $comunidadesSi=$poaParticipante->comunidades??null;
        $comunidadesNo=Comunidad::whereNotIn('id',$comunidadesSi->pluck('id'))->get();
        $tipoParticipantesSi=$poaParticipante->tipoParticipantes??null;
        $tipoParticipantesNo=TipoParticipante::whereNotIn('id',$tipoParticipantesSi->pluck('id'))->get();
        $coordinadores=Coordinador::all();

        $data = array(
            'poa'=>$poa,
            'comunidadesSi'=>$comunidadesSi,
            'comunidadesNo'=>$comunidadesNo,
            'tipoParticipantesSi'=>$tipoParticipantesSi,
            'tipoParticipantesNo'=>$tipoParticipantesNo
        );
        return view('poas.participantes.index',$data);
    }

    public function actualizarMeses($poaParticipante)
    {

        $planificacion= $poaParticipante->poa->planificacionModelo->planificacion;
        $desde=$planificacion->desde;
        $hasta=$planificacion->hasta;

        $periodos = CarbonPeriod::create($desde, '1 month', $hasta);
        $misMeses=[];
        foreach ($periodos as $dt) {
            $meses=Mes::get();
            $fecha =Carbon::parse($dt);
            $mes = $meses->pluck('mes')[($fecha->format('n')) - 1];
            array_push($misMeses,$mes);
        }
        $mesSync=[];
        foreach ($misMeses as $mesz) {
            $mes_m=Mes::where('mes',$mesz)->first();
            array_push($mesSync,$mes_m->id);
        }
        
        return $poaParticipante->meses()->sync($mesSync);
        
    }

    public function actualizar(Request $request)
    {
        $request->validate([
            'poa' => 'required|exists:poa,id',
            'descripcion' => 'required|max:255',
        ]);
        $poa=Poa::findOrFail($request->poa);
        $poa->poaParticipante->descripcion=$request->descripcion;
        $poa->poaParticipante->save();
        $request->session()->flash('success','Descripción de Poa Participante actualizado');
        return redirect()->route('poaParticipantes',$poa->id);
    }


    public function actualizarComunidades(Request $request)
    {
        
        $request->validate([
            'poa' => 'required|exists:poa,id',
            "comunidades"    => "nullable|array",
            "comunidades.*"  => "nullable|exists:comunidad,id",
        ]);
        $poa=Poa::findOrFail($request->poa);
        $poa->poaParticipante->comunidades()->sync($request->comunidades);

        $request->session()->flash('tabs','comunidades-tab');
        $request->session()->flash('success','Comunidades de Poa Participante actualizado');
        return redirect()->route('poaParticipantes',$poa->id);
    }

    public function actualizarTipoParticipantes(Request $request)
    {
        $request->validate([
            'poa' => 'required|exists:poa,id',
            "tipoParticipantes"    => "nullable|array",
            "tipoParticipantes.*"  => "nullable|exists:tipoParticipante,id",
        ]);
        $poa=Poa::findOrFail($request->poa);
        $poa->poaParticipante->tipoParticipantes()->sync($request->tipoParticipantes);
        $request->session()->flash('tabs','tipoParticipantes-tab');
        $request->session()->flash('success','Tipo participantes de Poa Participante actualizado');
        return redirect()->route('poaParticipantes',$poa->id);
    }

    public function actualizarCoordinador(Request $request)
    {
        $request->validate([
            "comunidadPoaParticipante"    => "required|array",
            "comunidadPoaParticipante.*"  => "required|exists:comunidadPoaParticipante,id",
            "coordinador"    => "required|array",
            "coordinador.*"  => "required|exists:users,id",
        ]);

        if($request->comunidadPoaParticipante){
            $i=0;
            foreach ($request->comunidadPoaParticipante as $comunidadParticipante) {
                $cpp=ComunidadPoaParticipante::findOrFail($comunidadParticipante);
                
                $cpp->gestor_id=$cpp->comunidad->usuario->id;
                $cpp->coordinador_id=$request->coordinador[$i];
                $cpp->save();
                $i++;
            }
        }


        // $cpp=ComunidadPoaParticipante::findOrFail($request->comunidadPoaParticipante);
        // $cpp->gestor_id=$cpp->comunidad->usuario->id;
        // $cpp->coordinador_id=$request->coordinador;
        // $cpp->save();

        $request->session()->flash('tabs','coordinadores-tab');
        $request->session()->flash('success','Coordinador de Poa Participante actualizado');
        return redirect()->route('poaParticipantes',$cpp->poaParticipante->poa_id);
    }

    public function actualizarValorMes(RqPoaParticipanteValorMes $request)
    {
        
        if($request->poaPartMes){
        
            foreach ($request->poaPartMes as $ppm) {
                $PoaParticipanteMes=PoaParticipanteMes::findOrFail($ppm);
                $PoaParticipanteMes->valor=$request->valores[$ppm];
                $PoaParticipanteMes->save();
            }
            
        }
        $request->session()->flash('tabs','meses-tab');
        $request->session()->flash('success','Valores actualizado');
        return redirect()->route('poaParticipantes',$request->poa);
       
    }
      
}
