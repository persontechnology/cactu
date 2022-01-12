<?php

namespace cactu\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use cactu\Http\Controllers\Controller;
use cactu\DataTables\Usuarios\ParticipantesDataTable;
use cactu\User;
use cactu\Models\Localidad\Comunidad;
use cactu\Models\TipoParticipante;

class Participantes extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['auth','role_or_permission:Administrador|G. de participantes']);
    }
    public function index(ParticipantesDataTable $dataTable)
    {
        return $dataTable->render('usuario.participantes.index');
    }
    public function asignacion($idUser)
    {
        $usuario=User::findOrFail($idUser);
        
        $comunidadesAsignadas=$usuario->participantes()->pluck('comunidad.id');
        $comunidadesNoAsignadas=Comunidad::whereIn('nombre',['CACTU-COTOPAXI','CACTU-TUNGURAHUA'])
        ->whereNotIn('id',$comunidadesAsignadas)
        ->get();

        $data = array(
                        'usuario' => $usuario,
                        'comunidadesAsignadas'=>$usuario->participantes,
                        'comunidadesNoAsignadas'=>$comunidadesNoAsignadas
                    );
        return view('usuario.participantes.asignar',$data);
    }

    public function asignarComunidades(Request $request)
    {
        
        $request->validate([
            'usuario' => 'required|exists:users,id',
            "comunidades"    => "nullable|array|max:1",
            "comunidades.*"  => "nullable|exists:comunidad,id",
        ]);
        
        $usuario=User::findOrFail($request->usuario);
        $tipoParticipante=TipoParticipante::where('nombre','Participante socio local')->first();
        
        $data_to_sync = [];
        if($request->comunidades){
            foreach ($request->comunidades as $comunidad)
            {
                $pivot_data = ['tipoParticipante_id' => $tipoParticipante->id];
                $data_to_sync[$comunidad] = $pivot_data;
            }
        }
        $usuario->participantes()->sync($data_to_sync);
        $request->session()->flash('success','Comunidades asignadas');
        return redirect()->route('participantes');
        
    }
}
