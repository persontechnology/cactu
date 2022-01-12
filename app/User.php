<?php

namespace cactu;

use cactu\Models\Archivo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use cactu\Models\Localidad\Provincia;
use cactu\Models\Localidad\Comunidad;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','identificacion'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // A:deivid
    // D: un suario tiene varios archivos excel para descargar
    public function archivos_m()
    {
        return $this->belongsToMany(Archivo::class, 'archivousers', 'user_id', 'archivo_id')
        ->withPivot('id')->as('u');
    }

    // A.Deivid
    // D:un usuario coordinador tiene varios provincias asignadas
    public function provincias()
    {
        return $this->belongsToMany(Provincia::class, 'coordinador', 'user_id', 'provincia_id');
    }

    // A:Deivid
    // D: un usuario gestor tiene varias comunidades asigndas
    public function comunidades()
    {
        return $this->hasMany(Comunidad::class, 'user_id');
    } 

    //A:Deivid
    // D: retornar usuarios creado y actualizado por
    public function creadoPor($idUsuario)
    {
        $user=$this::find($idUsuario);
        if($user){
            return $user;
        }
        return '';
    }

    public function actualizadoPor($idUsuario)
    {
        $user=$this::find($idUsuario);
        if($user){
            return $user;
        }
        return '';
    }

    // A.Deivid
    // D:un usuario coordinador tiene varios provincias asignadas
    public function participantes()
    {
        return $this->belongsToMany(Comunidad::class, 'ninio', 'user_id', 'comunidad_id');
    }
}
