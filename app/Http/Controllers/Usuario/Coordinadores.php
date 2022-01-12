<?php

namespace cactu\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use cactu\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use cactu\User;
use Illuminate\Support\Facades\Hash;
use cactu\DataTables\Usuarios\CoordinadoresDataTable;
use cactu\Models\Localidad\Provincia;
use cactu\Http\Requests\Usuarios\RqActualizar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Coordinadores extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role_or_permission:Administrador|G. de coordinadores']);
    }

    public function index(CoordinadoresDataTable $dataTable)
    {
        return $dataTable->render('usuario.coordinadores.index');
    }

    public function nuevo()
    {
        return view('usuario.coordinadores.nuevo');
    }

    public function guardar(Request $request)
    {
        $user= User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->creadoPor=Auth::user()->id;
        $user->save();
        $user->assignRole('Coordinador');
        $request->session()->flash('success','Coordinador ingresado');
        return redirect()->route('coordinadores');
    }

    public function asignarProvincias($idUsuario)
    {
        $user=User::findOrFail($idUsuario);
        if($user->hasRole('Coordinador')){
            
            $proncinciasAsignadas=$user->provincias;
            $provinciasNoAsignadas=Provincia::whereNotIn('id',$proncinciasAsignadas->pluck('id'))->get();
            $data = array(
                'provinciasAsignadas' => $proncinciasAsignadas,
                'provinciasNoAsignadas'=>$provinciasNoAsignadas,
                'usuario'=>$user
             );
            return view('usuario.coordinadores.asignarProvincias',$data);
        }
        return abort(404);
    }

    public function actualizarAsignacionProvincia(Request $request)
    {
        $request->validate([
            'usuario' => 'required|exists:users,id',
            "provincias"    => "nullable|array|max:1",
            "provincias.*"  => "nullable|exists:provincia,id",
        ]);

        $user=User::findOrFail($request->usuario);
        if($user->hasRole('Coordinador')){
            $user->provincias()->sync($request->provincias);
            $user->actualizadoPor=Auth::user()->id;
            $user->save();
            $request->session()->flash('success','Provincias asignados');
            return redirect()->route('coordinadores');
        }
        
        return abort(404);
    }


    public function editar($idUsuario)
    {
        $usuario=User::findOrFail($idUsuario);
        if($usuario->hasRole('Coordinador')){
            return view('usuario.coordinadores.editar',['usuario'=>$usuario]);
        }
        return abort(404);
        
    }

    public function actualizar(RqActualizar $request)
    {
        $user=User::findOrFail($request->usuario);
        if($user->hasRole('Coordinador')){
            $user->name=$request->name;
            $user->email=$request->email;
            if($request->password){
                $user->password=Hash::make($request->password);
            }
            $user->estado=$request->estado;
            $user->actualizadoPor=Auth::user()->id;
            $user->save();
            $request->session()->flash('success','Coordinador actualizado');

            return redirect()->route('coordinadores');
        }
        return abort(404);
        
    }
  

    public function eliminar(Request $request)
    {
        $request->validate([
            'user' => 'required|exists:users,id',
        ]);
        
        try {
            DB::beginTransaction();

            $user=User::findOrFail($request->user);
            if(Auth::user()->id!=$user->id){
                if($user->hasRole('Coordinador')){
                    $urlFoto=$user->foto;
                    if($user->delete()){
                        Storage::delete($urlFoto);
                    }
                    DB::commit();
                    return response()->json(['success'=>'Coordinador eliminado']);
                }
                
            }else{
                return response()->json(['default'=>'No se puede autoeliminarse']);
            }
            
        } catch (\Exception $th) {
            DB::rollBack();
            return response()->json(['default'=>'No se puede eliminar coordinador']);
        }
    }
}
