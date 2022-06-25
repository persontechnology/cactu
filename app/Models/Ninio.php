<?php

namespace cactu\Models;

use cactu\Models\Buzon\Buzon;
use cactu\Models\Buzon\BuzonCarta;
use Illuminate\Database\Eloquent\Model;
use cactu\Models\Localidad\Comunidad;
use cactu\Models\Familia;
use cactu\Models\Registro\Listado;
use cactu\Models\TipoParticipante;
use cactu\User;
use Carbon\Carbon;
use cactu\Models\Buzon\MensajeNinio;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Ninio extends Model
{
    use HasApiTokens,Notifiable;
    
    protected $table = 'ninio';

    protected $fillable = [
        'comumidad','casoParticipante','numeroChild', 'nombres','genero','fechaNacimiento','estadoPatrocinio','fechaRegistro','latitud','longitud','comunidad_id','usuarioCreado','usuarioActualizado','tipoParticipante_id',
    ];

    public function comunidad()
    {
    	return $this->belongsTo(Comunidad::class,'comunidad_id');
    }
    public function tipoParticipante()
    {
    	return $this->belongsTo(TipoParticipante::class,'tipoParticipante_id');
    }
    public function familia()
    {
        return $this->hasOne(Familia::class,'ninio_id');
    }
    public function creadoPor($idUsuario)
    {
        return User::findOrFail($idUsuario);
    }
    public function actualizadoPor($idUsuario)
    {
        return User::findOrFail($idUsuario);
    }



    // A.Deivid
    // D.un ninio tien un usuario
    public function usuario()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function comunidad_model()
    {
    	return $this->belongsTo(Comunidad::class,'comunidad_id');
    }
    //A.Lopez 
    //relizar la busqueda para ve cuantas asistencias tiene 

    public function listados()
    {
        return $this->hasMany(Listado::class,'ninio_id')->orderBy('created_at','desc');
    }
     //A.Lopez 
    //relizar la busqueda para ve cuantas asistencias tiene 

    public function carpetaNinio()
    {
        return $this->hasMany(CarpetaNinio::class,'ninio_id');
    }
      //A.Fabian Lopez
    // buscar si existen buzon de hoy
    public function cartasHoy()
    {
        $diaHoy=Carbon::now();
               
        return $this->hasMany(Buzon::class)
        ->where('fecha',Carbon::now()->toDateString());
    }
     //A.Lopez 
    //realizar la busqueda para ve cuantas asistencias tiene 

    public function buzones()
    {
        return $this->hasMany(Buzon::class,'ninio_id')->orderBy('fecha','desc');
    }

    public function mensajesNinio()
    {
        return $this->hasMany(MensajeNinio::class,'ninio_id')->orderBy('fecha','desc');
    }

    // Deivid, cartas de ninios
    // ninio->buzon->buzoncartas
    public function buzonCartasNinioDirecto()
    {
        return $this->hasManyThrough(
            BuzonCarta::class,
            Buzon::class,
            'ninio_id', // Foreign key on the ninio table...
            'buzon_id', // Foreign key on the buzon carta table...
            'id', // Local key on the ninio table...
            'id' // Local key on the buzon table...
        );
    }

}
