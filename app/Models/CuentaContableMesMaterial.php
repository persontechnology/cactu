<?php

namespace cactu\Models;
use cactu\Models\Material;
use cactu\Models\Acta;
use Illuminate\Database\Eloquent\Model;

class CuentaContableMesMaterial extends Model
{
    public function material()
    {
        return $this->belongsTo(Material::class,'material_id');
    }
    public function acta()
    {
        return $this->belongsTo(Acta::class,'acta_id');
    }
}
