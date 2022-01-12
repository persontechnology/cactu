<?php

namespace cactu\Models;

use Illuminate\Database\Eloquent\Model;
use cactu\Models\ModeloProgramatico;
class Actividad extends Model
{
    protected $table = 'actividad';

     protected $fillable = [
        'nombre', 'codigo','modeloProgramatico_id'
    ];
    public function modeloProgramatico()
    {
    	 return $this->belongsTo(ModeloProgramatico::class,'modeloProgramatico_id');
    }
}
