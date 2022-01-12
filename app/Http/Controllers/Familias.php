<?php

namespace cactu\Http\Controllers;

use cactu\Http\Requests\Ninios\RqFamilia;
use Illuminate\Http\Request;
use cactu\Models\Familia;
use cactu\Models\Ninio;
use Illuminate\Support\Facades\Auth;
class Familias extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
        
    }
    public function index($idNinio)
    {
    	$ninio=Ninio::findOrFail($idNinio);
    	$data = array('ninio' =>$ninio , );
    	return view('familias.index',$data);
    }

    public function guardar(RqFamilia $request)
    {
        $ninio=Ninio::findOrFail($request->ninio);

        if($ninio->familia){ 
            $familia=Familia::findOrFail($ninio->familia->id);
            $familia->actualizadoPor=Auth::id();
            $request->session()->flash('success','Familia actualizada de '. $ninio->nombres);
        
        }else{
            $familia= new Familia();
            $familia->ninio_id=$ninio->id;        
            $familia->creadoPor=Auth::id();
            $request->session()->flash('success','Familia creada de '. $ninio->nombres);
        }
        
        $familia->papa=$request->papa;
        $familia->mama=$request->mama;
        // $familia->hermano1=$request->hermano1;
        // $familia->hermano2=$request->hermano2;
        // $familia->hermano3=$request->hermano3;
        // $familia->hermano4=$request->hermano4;
        // $familia->hermano5=$request->hermano5;
        // $familia->hermano6=$request->hermano6;
        // $familia->hermano7=$request->hermano7;
        // $familia->hermano8=$request->hermano8;
        // $familia->abuelo=$request->abuelo;
        // $familia->abuela=$request->abuela;
        // $familia->tio=$request->tio;
        // $familia->cunado=$request->cunado;
        // $familia->sobrino=$request->sobrino;
        /**este campo para el nombre del representante */
        $familia->otro1=$request->otro1;
        /**este campo para el nombre del celular */
        $familia->otro2=$request->otro2;
        /**este campo para el nombre del email */
        $familia->otro3=$request->otro3;
        // $familia->maestro=$request->maestro;
        $familia->save();
    
        return redirect()->route('familia',$ninio->id);
    }
}