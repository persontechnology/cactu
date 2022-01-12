<?php

namespace cactu\Imports;

use cactu\Models\Material;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class MaterialesImport implements ToModel
{
   
    public function model(array $row)
    {
        $material=Material::where('nombre',$row[0])->first();
        if(!$material){
            $materiales=new Material();
            $materiales->nombre=$row[0];
            $materiales->precio=$row[1];
            $materiales->iva=$row[2];
            $materiales->creadoPor=Auth::id();
            $materiales->save();

        }
        return $material;
    }
}
