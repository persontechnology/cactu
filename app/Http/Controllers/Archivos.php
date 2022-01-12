<?php

namespace cactu\Http\Controllers;

use cactu\DataTables\ArchivosDataTable;
use cactu\DataTables\ArchivosListaDataTable;
use cactu\Models\Archivo;
use cactu\Models\Archivouser;
use cactu\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class Archivos extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(ArchivosDataTable $dataTable)
    {
        return $dataTable->render('archivos.index');
    }

    public function listado(ArchivosListaDataTable $dataTable)
    {
        $this->authorize('gestionDeArchivos',Archivo::class);
        return $dataTable->render('archivos.lista');
    }

    public function nuevo()
    {
        $this->authorize('gestionDeArchivos',Archivo::class);
        $users=User::all();
        $data = array('users' => $users );
        return view('archivos.nuevo',$data);
    }

    public function guardar(Request $request)
    {
        $this->authorize('gestionDeArchivos',Archivo::class);
        $request->validate([
            'nombre'=>'required|string|max:255',
            'archivo'=>'required|max:90000',
            "users"    => "required|array",
            "users.*"  => "required|exists:users,id",
        ]);
        

        try {
            DB::beginTransaction();
            $archivo=new Archivo();
            $archivo->nombre=$request->nombre;
            $archivo->url='';
            $archivo->descripcion=$request->descripcion;
            $archivo->save();
            if ($request->hasFile('archivo')) {
                if ($request->file('archivo')->isValid()) {
                    $extension = $request->archivo->extension();
                    $path = Storage::putFileAs(
                        'public/archivos', $request->file('archivo'), Str::slug($archivo->nombre,'-').'_'.$archivo->id.'.'.$extension
                    );
                    $archivo->url=$path;
                    $archivo->save();
                }
            }

            
            
            
            foreach ($request->users as $u) {
                $a_u=new Archivouser();
                $a_u->user_id=$u;
                $a_u->archivo_id=$archivo->id;
                $a_u->save();
            }

            DB::commit();
            $request->session()->flash('success','Archivo guardado');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Archivo no guardado, vuelva intentar');
        }
        return redirect()->route('misArchivos');
    }

    public function editar($idArchivo)
    {
        $this->authorize('gestionDeArchivos',Archivo::class);
        $archivo=Archivo::findOrFail($idArchivo);
        $users=User::all();
        $data = array('ar' => $archivo ,'users'=>$users);
        return view('archivos.editar',$data);
    }

    public function actualizar(Request $request)
    {
        $this->authorize('gestionDeArchivos',Archivo::class);
        try {
            DB::beginTransaction();
            $archivo=Archivo::findOrFail($request->id);
            $archivo->nombre=$request->nombre;
            $archivo->descripcion=$request->descripcion;
            $archivo->save();
            if ($request->hasFile('archivo')) {
                if ($request->file('archivo')->isValid()) {
                    Storage::delete($archivo->url);
                    $extension = $request->archivo->extension();
                    $path = Storage::putFileAs(
                        'public/archivos', $request->file('archivo'), Str::slug($archivo->nombre,'-').'_'.$archivo->id.'.'.$extension
                    );
                    $archivo->url=$path;
                    $archivo->save();
                }
            }

            $archivo->users_m()->sync($request->users);

            DB::commit();
            $request->session()->flash('success','Archivo actualizado');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Archivo no compartido, vuelva intentar');
        }
        return redirect()->route('listadoArchivo');
    }

    public function eliminar(Request $request)
    {
        $this->authorize('gestionDeArchivos',Archivo::class);
        $archivo=Archivo::findOrFail($request->archivo);
        try {
            DB::beginTransaction();
            $archivo->users_m()->detach();
            $archivo->delete();
            Storage::delete($archivo->url);
            DB::commit();
            return response()->json(['success'=>'Archivo eliminado']);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['default'=>'No se puede eliminar archivo']);
        }
    }
}
