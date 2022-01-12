<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

        <!-- Sidebar mobile toggler -->
        <div class="sidebar-mobile-toggler text-center">
            <a href="#" class="sidebar-mobile-main-toggle">
                <i class="icon-arrow-left8"></i>
            </a>
            Navigación
            <a href="#" class="sidebar-mobile-expand">
                <i class="icon-screen-full"></i>
                <i class="icon-screen-normal"></i>
            </a>
        </div>
        <!-- /sidebar mobile toggler -->
    
        
        <!-- Sidebar content -->
        <div class="sidebar-content">
    
            <!-- Main navigation -->
    
            <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
    
                
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">Navegación</div> 
                    <i class="icon-menu" title="Navegación"></i>
                </li>
                
                {{--  menus del sistema  --}}
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link" id="menuEscritorio">
                        <i class="icon-home4"></i>
                        <span>
                            Inicio
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('misArchivos') }}" class="nav-link" id="menuArchivos">
                        <i class="fas fa-folder-open"></i>
                        <span>
                            Mis archivos
                        </span>
                    </a>
                </li>
                
                @can('GestionDeUsuarios', cactu\User::class)
                <li class="nav-item">
                    <a href="{{ route('usuarios') }}" class="nav-link" id="menuUsuarios">
                        <i class="fas fa-users"></i>
                        <span>
                            Usuarios
                        </span>
                    </a>
                </li>
                @endcan

                
                @can('GestionDeCoordinadores', cactu\User::class)
                <li class="nav-item">
                    <a href="{{ route('coordinadores') }}" class="nav-link" id="menuCoordinadores">
                        <i class="fas fa-users"></i>
                        <span>
                            Coordinadores
                        </span>
                    </a>
                </li>
                @endcan

                @can('GestionDeGestores', cactu\User::class)
                <li class="nav-item">
                    <a href="{{ route('gestores') }}" class="nav-link" id="menuGestores">
                        <i class="fas fa-users"></i>
                        <span>
                            Gestores
                        </span>
                    </a>
                </li>
                @endcan


                @can('GestionDeParticipantes', cactu\User::class)
                <li class="nav-item">
                    <a href="{{ route('participantes') }}" class="nav-link" id="menuParticipantes">
                        <i class="fas fa-users"></i>
                        <span>
                            Personal SL.
                        </span>
                    </a>
                </li>
                @endcan
                
                
                
                

                
                @can('GestionDeComunidad',cactu\Models\Localidad\Comunidad::class)
                <li class="nav-item nav-item-submenu" id="menuLocalidad">
                    <a href="#" class="nav-link">
                        <i class="fas fa-globe-americas"></i>
                        <span>Localidades</span>
                    </a>
                    <ul class="nav nav-group-sub" data-submenu-title="Form components">
                        <li class="nav-item">
                            <a href="{{ route('provincias') }}" class="nav-link" id="menuProvincia">Provincias</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cantones') }}" class="nav-link" id="menuCanton">Cantones</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('comunidades') }}" class="nav-link" id="menuComunidad">Comunidades</a>
                        </li>

                    </ul>
                </li>
                @endcan


                @can('GestionDeModeloProgramatico',cactu\Models\ModeloProgramatico::class)
                <li class="nav-item">
                    <a href="{{route('modelos')}}" class="nav-link" id="menuModeloProgramatico">
                        <i class="icon-archive"></i>
                        <span>
                            Modelos Programáticos
                        </span>
                    </a>
                </li>
                @endcan

                
                @can('GestionDeTipoParticipante',cactu\Models\TipoParticipante::class)
                <li class="nav-item">
                    <a href="{{route('tipos-participante')}}" class="nav-link" id="menuTipoParticipante">
                        <i class="icon-user-tie"></i>
                        <span>
                            Tipo de participantes
                        </span>
                    </a>
                </li>
                @endcan
                

                @can('GestionDeCuentaContable', cactu\Models\CuentaContable::class)
                <li class="nav-item">
                    <a href="{{route('cuentas-contables')}}" class="nav-link" id="menuCuentaContable">
                        <i class="icon-book"></i>
                        <span>
                            Cuentas contables
                        </span>
                    </a>
                </li>
                @endcan

                @can('GestionDeNinios', cactu\Models\Ninio::class)
                <li class="nav-item">
                    <a href="{{route('ninios')}}" class="nav-link" id="menuNinios">
                        <i class="icon-users4"></i>
                        <span>
                            Participantes
                        </span>
                    </a>
                </li>
                @endcan

                @if (Auth::user()->hasRole('Gestor'))
                    <li class="nav-item">
                        <a href="{{ route('misParticipantes') }}" class="nav-link" id="misParticipantes">
                            <i class="icon-users4"></i>
                            <span>
                                Mis participantes
                            </span>
                        </a>
                    </li>
                @endif
                
                @can('GestionDePlanificacion', cactu\Models\Planificacion::class)
                    
                
                <li class="nav-item">
                    <a href="{{route('planificaciones')}}" class="nav-link" id="menuPlanificacion">
                        <i class="icon-stack-plus"></i>
                        <span>
                           Planificaciones
                        </span>
                    </a>
                </li>
                
                @endcan


                @can('RegistroAsistenciaActividades', cactu\Models\Registro\Asistencia::class)
                <li class="nav-item">
                    <a href="{{route('asistencia')}}" class="nav-link" id="menuRegistroAsistencia">
                        <i class="far fa-calendar-check"></i>
                        <span>
                           Registro de asistencia a actividades
                        </span>
                    </a>
                </li>
                @endcan



                
                @role('Administrador')
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">SISTEMA</div> 
                    <i class="icon-menu" title="Sistemas"></i>
                </li>

                <li class="nav-item">
                    <a href="{{ route('roles') }}" class="nav-link" id="menuRoles">
                        <i class="fas fa-unlock-alt"></i>
                        <span>
                            Roles y permisos
                        </span>
                    </a>
                </li>
                @endrole
    
                
                
                <!-- /page kits -->
    
            </ul>
        </div>
            
            <!-- /main navigation -->
    
        </div>
        <!-- /sidebar content -->
        
    </div>