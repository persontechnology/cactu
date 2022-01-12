<?php

namespace cactu\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use cactu\Models\Ninio;
use cactu\Models\Localidad\Comunidad;
use cactu\Models\TipoParticipante;
use cactu\Models\Familia;
use Carbon\Carbon;
class NiniosImport implements ToModel,WithBatchInserts, WithChunkReading

{

    public function model(array $row)
    {
        $comunidad=Comunidad::where('nombre',$row[1])->first();
        $tipoParticipanteAfi=TipoParticipante::where('nombre',"INNAJ Inscritos/afiliados")->first();
        $tipoParticipanteComu=TipoParticipante::where('nombre',"Comunitario")->first(); 
        // verificar si los datos estan correctos     
        if($comunidad && $tipoParticipanteAfi && $tipoParticipanteComu){          
            if($row[3]!="" ){ 
                if(is_numeric($row[3])){                 
                    $ninioAfi=Ninio::where('numeroChild',$row[3])->first();
                    if(!$ninioAfi){      
                        $nuevoNinio= new Ninio();
                        if(is_numeric($row[0])){
                            $nuevoNinio->comumidad=$row[0];
                        }
                        $nuevoNinio->comunidad_id=$comunidad->id;
                        if(is_numeric($row[2])){
                        $nuevoNinio->casoParticipante=$row[2];
                        }
                  
                        $nuevoNinio->numeroChild=$row[3];
                        $nuevoNinio->nombres=$row[4];
                        $nuevoNinio->genero=$row[5];
                        if($row[6]!=" "){
                        $nuevoNinio->fechaNacimiento=Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6]));
                        }
                        $nuevoNinio->estadoPatrocinio= $row[7];

                        if($row[8]!=" "){
                        $nuevoNinio->fechaRegistro=Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[8]));
                        }
                        $nuevoNinio->tipoParticipante_id=$tipoParticipanteAfi->id;
                        $nuevoNinio->creadoPor=Auth::id();
                        $nuevoNinio->save();
                        $familia= new Familia();
                        $familia->papa=$row[11]??'';
                        $familia->mama=$row[12]??'';
                        $familia->hermano1=$row[13]??'';
                        $familia->hermano2=$row[14]??'';
                        $familia->hermano3=$row[15]??'';
                        $familia->hermano4=$row[16]??'';
                        $familia->hermano5=$row[17]??'';
                        $familia->hermano6=$row[18]??'';
                        $familia->hermano7=$row[19]??'';
                        $familia->hermano8=$row[20]??'';
                        $familia->abuelo=$row[21]??'';
                        $familia->abuela=$row[22]??'';
                        $familia->tio=$row[23]??'';
                        $familia->cunado=$row[24]??'';
                        $familia->sobrino=$row[25]??'';
                        $familia->otro1=$row[26]??'';
                        $familia->otro2=$row[27]??'';
                        $familia->otro3=$row[28]??'';
                        $familia->maestro=$row[29]??'';
                        $familia->ninio_id=$nuevoNinio->id;
                        $familia->creadoPor=Auth::id();
                        $familia->save();
                    }
                }
                }else{
                    
                    $ninioComu=Ninio::where('nombres',$row[4])->first();
                    if(!$ninioComu){
                        $nuevoNinioComu= new Ninio();
                        $nuevoNinioComu->comumidad=0;
                        $nuevoNinioComu->comunidad_id=$comunidad->id;
                        $nuevoNinioComu->casoParticipante=null; 
                        $nuevoNinioComu->numeroChild=null;
                        $nuevoNinioComu->nombres=$row[4];
                        $nuevoNinioComu->genero=$row[5];
                        if($row[6]!=" "){
                        $nuevoNinioComu->fechaNacimiento=Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6]));
                        }
                        $nuevoNinioComu->estadoPatrocinio= $row[7];

                        if($row[8]!=" "){
                        $nuevoNinioComu->fechaRegistro=Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[8]));
                        }
                        $nuevoNinioComu->tipoParticipante_id=$tipoParticipanteComu->id;
                        $nuevoNinioComu->creadoPor=Auth::id();
                        $nuevoNinioComu->save();
                    }
                     
                }           

            }
    }   
    public function batchSize(): int
    {
        return 1000;
    }
     public function chunkSize(): int
    {
        return 1000;
    }
}
