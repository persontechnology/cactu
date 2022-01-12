<?php

namespace cactu\Models;

use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    protected $table = 'familia';

    protected $fillable = [
        'papa','mama','hermano1', 'hermano2','hermano3','hermano4','hermano5','hermano6','hermano7','hermano8','abuelo','abuela','tio','cunado','sobrino','otro1','otro2','otro3','maestro','ninio_id','creadoPor','actualizadoPor'
    ];
}
