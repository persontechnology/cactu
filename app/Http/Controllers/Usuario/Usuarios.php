<?php

namespace cactu\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use cactu\Http\Controllers\Controller;
use cactu\DataTables\Usuarios\UsuariosDataTable;
use cactu\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use cactu\Http\Requests\Usuarios\RqGuardar;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use cactu\Http\Requests\Usuarios\RqActualizar;
use cactu\DataTables\Usuarios\PorRolDataTable;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

use cactu\Imports\UsuariosImport;
use Illuminate\Support\Facades\Storage;

class Usuarios extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role_or_permission:Administrador|G. de usuarios']);
        ini_set("memory_limit", "100M");
        ini_set('post_max_size', '50M');
        ini_set('upload_max_filesize', '50M');
    }

    public function index(UsuariosDataTable $dataTable)
    {
        $roles=Role::all();
        return $dataTable->render('usuario.usuarios.index',['roles'=>$roles]);
    }

    // Autor:Deivid
    // Desc:vista nuevo contacto de usuario enviamos todos los roles
    public function nuevo()
    {
        $roles=Role::all();
        $user=Auth::user();
        return view('usuario.usuarios.nuevo',['roles'=>$roles]);
    }

    // Autor:Deivid
    // Desc:guardar nuevo usuario con roles
    public function guardar(RqGuardar $request)
    {
        $user= new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->identificacion = $request->identificacion;
        $user->password = Hash::make($request->password);
        $user->creadoPor=Auth::user()->id;
        $user->save();
        $user->assignRole($request->roles);
         
        $request->session()->flash('success','Usuario ingresado');
        return redirect()->route('usuarios');
    }

    public function eliminar(Request $request)
    {
        $request->validate([
            'user' => 'required|exists:users,id',
        ]);
        
        try {
            DB::beginTransaction();

            $user=User::findOrFail($request->user);
            $this->authorize('eliminarUsuario', $user);
            if(Auth::user()->id!=$user->id){
                $urlFoto=$user->foto;
                if($user->delete()){
                    Storage::delete($urlFoto);
                }
                DB::commit();
                return response()->json(['success'=>'Usuario eliminado']);
                
            }else{
                return response()->json(['default'=>'No se puede autoeliminarse']);
            }
            
        } catch (\Exception $th) {
            DB::rollBack();
            return response()->json(['default'=>'No se puede eliminar usuario']);
        }
    }

    // A: Deivid
    // D: Actualizar roles de usuario
    public function editarRol($idUsuario)
    {
        $user=User::findOrFail($idUsuario);
        $roles=Role::all();
        $data = array('usuario' => $user,'roles'=>$roles );
        return view('usuario.usuarios.actualizarRol',$data);
    }

    // A:Deivid
    // D: sincronizar los roles de usuarios
    public function actualizarRolUsuario(Request $request)
    {
        $request->validate([
            'usuario' => 'required|exists:users,id',
            "roles"    => "nullable|array",
            "roles.*"  => "nullable|exists:roles,id",
        ]);
        $user=User::findOrFail($request->usuario);        
        $user->syncRoles($request->roles);
        $user->actualizadoPor=Auth::user()->id;
        $user->save();
        $request->session()->flash('success','Roles de usuario actualizado');
        return redirect()->route('usuarios');
    }

    // A:Deivid
    // D: Actualizar usuario
    public function editar($idUsuario)
    {
        $user=User::findOrFail($idUsuario);
        return view('usuario.usuarios.editar',['usuario'=>$user]);
    }
    
    public function actualizar(RqActualizar $request)
    {
        
        $user=User::findOrFail($request->usuario);
        
        $user->name=$request->name;
        $user->email=$request->email;
        if($request->password){
            $user->password=Hash::make($request->password);
        }
        $user->identificacion=$request->identificacion;
        $user->estado=$request->estado;
        $user->actualizadoPor=Auth::user()->id;
        $user->save();
        $request->session()->flash('success','Usuario actualizado');
        return redirect()->route('usuarios');
    }

    // A:Deivid
    // D:Infromacion total de usuario
    public function informacion($idUsuario)
    {
        $user=User::findOrFail($idUsuario);
        return view('usuario.usuarios.informacion',['usuario'=>$user]);
    }

    // A:Deivid
    // D:obtener usuarios por rol, se utliza la misma vista y diferente datatable
    public function usuariosPoRol(PorRolDataTable $dataTable, $nombreRol)
    {
        try {
            $role = Role::findByName($nombreRol);
            $roles=Role::all();
            return $dataTable->with('rol',$role->name)->render('usuario.usuarios.index',['roles'=>$roles]);
        } catch (\Exception $th) {
            return abort(404);
        }
    }

    //A:Deivid
    //D:Descargar infromacion de usuario a pdf
    public function informacionPdf($idUsuario)
    {
        $user=User::findOrFail($idUsuario);
        $pdf = PDF::loadView('usuario.usuarios.pdf',['usuario'=>$user]);
        return $pdf->inline();
    }

    // A:Deivid
    // D:Imprimir informaciond de usuario
    public function informacionImprimir($idUsuario)
    {
        $user=User::findOrFail($idUsuario);
        return view('usuario.usuarios.imprimir',['usuario'=>$user]);
    }

    // A:Deivid
    // D:importar usuarios
    public function importar()
    {
        return view('usuario.usuarios.importar');
    }

    public function procesarImportacion(Request $request)
    {            
           
        $request->validate([
            'archivo' => 'required'
        ]);
        try {
            Excel::import(new UsuariosImport, $request->file('archivo'));            
        } catch (\Exception $ex) {
            return back()->withErrors('success', 'Usuarios importados');            
        }
        
        return redirect()->route('usuarios')->with('success', 'Usuarios importados');
        
    }


    // A:deivid
    // D:firmas  de usuario 
    public function firma(Request $request,$idUser)
    {
        $user=User::findOrFail($idUser);
        $data = array('usuario' => $user );
        return view('usuario.usuarios.firma',$data);
    }

    public function procesarFirma(Request $request)
    {
        $user=User::findOrFail($request->user);
         if ($request->hasFile('foto')) {
            if ($request->file('foto')->isValid()) {
                $extension = $request->foto->extension();
                $nombreFoto=$user->id.'.jpg';
                $path = Storage::putFileAs(
                    'public/firmas/',$request->file('foto'),$nombreFoto
                );
                $url = Storage::url("public/firmas/".$nombreFoto);
                $user->firma=$url;
                $user->save();
               $data_res = array('success' =>"Firma registrada exitosamente");
            }                  
        }else{
            $data_res = array('error' =>'No se puede registrar la firma');
        }    
        
        return response()->json($data_res);
    }

}
