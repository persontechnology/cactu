<?php

namespace cactu\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use cactu\Http\Controllers\Controller;
use cactu\DataTables\Usuarios\GestoresDataTable;
use Illuminate\Support\Facades\Auth;
use cactu\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use cactu\Http\Requests\Usuarios\RqActualizar;
use cactu\Models\Localidad\Comunidad;
use Illuminate\Support\Facades\Storage;

class Gestores extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role_or_permission:Administrador|G. de gestores']);
    }

    public function index(GestoresDataTable $dataTable)
    {
        return $dataTable->render('usuario.gestores.index');
    }

    public function nuevo()
    {
        return view('usuario.gestores.nuevo');
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
        $user->assignRole('Gestor');
        $request->session()->flash('success','Gestor ingresado');
        return redirect()->route('gestores');
    }

    public function editar($idUsuario)
    {
        $usuario=User::findOrFail($idUsuario);
        return view('usuario.gestores.editar',['usuario'=>$usuario]);
    }
    public function actualizar(RqActualizar $request)
    {
        $user=User::findOrFail($request->usuario);
        if($user->hasRole('Gestor')){
            $user->name=$request->name;
            $user->email=$request->email;
            if($request->password){
                $user->password=Hash::make($request->password);
            }
            $user->estado=$request->estado;
            $user->actualizadoPor=Auth::user()->id;
            $user->save();
            $request->session()->flash('success','Gestor actualizado');

            return redirect()->route('gestores');
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
                if($user->hasRole('Gestor')){
                    $urlFoto=$user->foto;
                    if($user->delete()){
                        Storage::delete($urlFoto);
                    }
                    DB::commit();
                    return response()->json(['success'=>'Gestor eliminado']);
                }
                
            }else{
                return response()->json(['default'=>'No se puede autoeliminarse']);
            }
            
        } catch (\Exception $th) {
            DB::rollBack();
            return response()->json(['default'=>'No se puede eliminar gestor']);
        }
    }
}
