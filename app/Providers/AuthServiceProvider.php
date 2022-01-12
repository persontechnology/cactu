<?php

namespace cactu\Providers;

use cactu\Models\Acta;
use cactu\Models\Archivo;
use cactu\Models\CuentaContable;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use cactu\User;
use cactu\Policies\UsuariosPolicy;
use cactu\Models\Localidad\Comunidad;
use cactu\Models\Material;
use cactu\Models\ModeloProgramatico;
use cactu\Models\Ninio;
use cactu\Models\Planificacion;
use cactu\Models\PlanificacionModelo;
use cactu\Models\Poa\Poa;
use cactu\Models\Poa\PoaCuentas\PoaCuentaContableMes;
use cactu\Models\Poa\PoaParticipantes\ComunidadPoaParticipante;
use cactu\Models\Registro\Asistencia;
use cactu\Policies\ComunidadPolicy;
use cactu\Models\TipoParticipante;
use cactu\Policies\ActasPolicy;
use cactu\Policies\ArchivoPolicy;
use cactu\Policies\AsistenciaPolicy;
use cactu\Policies\ComunidadPoaParticipantePolicy;
use cactu\Policies\CuentaContablePolicy;
use cactu\Policies\MaterialPolicy;
use cactu\Policies\ModeloProgramaticoPolicy;
use cactu\Policies\NiniosPolicy;
use cactu\Policies\PlanificacionModeloPolicy;
use cactu\Policies\PlanificacionPolicy;
use cactu\Policies\PoaPolicy;
use cactu\Policies\TipoParticipantePolicy;
use cactu\Policies\PoaCuentaContableMesPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UsuariosPolicy::class,
        Comunidad::class=> ComunidadPolicy::class,
        TipoParticipante::class=> TipoParticipantePolicy::class,
        Planificacion::class=>PlanificacionPolicy::class,
        PlanificacionModelo::class=>PlanificacionModeloPolicy::class,
        Poa::class=>PoaPolicy::class,
        ModeloProgramatico::class=>ModeloProgramaticoPolicy::class,
        CuentaContable::class=>CuentaContablePolicy::class,
        Ninio::class=>NiniosPolicy::class,
        ComunidadPoaParticipante::class=>ComunidadPoaParticipantePolicy::class,
        Asistencia::class=>AsistenciaPolicy::class,
        Material::class=>MaterialPolicy::class,
        PoaCuentaContableMes::class=>PoaCuentaContableMesPolicy::class,
        Acta::class=>ActasPolicy::class,
        Archivo::class=>ArchivoPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
