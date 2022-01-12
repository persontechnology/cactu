<?php
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Illuminate\Support\Str;

Breadcrumbs::for('inicio', function (BreadcrumbTrail $trail) {
    $trail->push('Inicio', url('/'));
});
// Administración
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Inicio', route('home'));
});
// Mi perfil
Breadcrumbs::for('miPerfil', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Mi perfil', route('miPerfil'));
});


// soporte
Breadcrumbs::for('soporte', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Soporte', route('soporte'));
});
// terminos  y condiciones
Breadcrumbs::for('terminosCondiciones', function (BreadcrumbTrail $trail) {
    $trail->parent('login');
    $trail->push('Términos y condiciones', route('terminosCondiciones'));
});

Breadcrumbs::for('login', function (BreadcrumbTrail $trail) {
    $trail->parent('inicio');
    $trail->push('Ingresar al sistema', route('login'));
});
Breadcrumbs::for('restablecerPassword', function (BreadcrumbTrail $trail) {
    $trail->parent('login');
    $trail->push('Restablecer contraseña', url('password/reset'));
});

/*autor:Fabian Lopez
descripcion: Breadcrumbs para modelos prograaticos*/
Breadcrumbs::for('modelosProgramaticos', function (BreadcrumbTrail $trail) {
	$trail->parent('home');
    $trail->push('Modelos programáticos', route('modelos'));
});
Breadcrumbs::for('nuevoModeloProgramatico', function (BreadcrumbTrail $trail) {	
	$trail->parent('modelosProgramaticos');
    $trail->push('Nuevo Modelo P.', route('nuevo-modelo'));
});
Breadcrumbs::for('editarModeloProgramatico', function (BreadcrumbTrail $trail,$modelo) {	
	$trail->parent('modelosProgramaticos');
    $trail->push('Actualizar Modelo P. '. $modelo->nombre, route('editar-modelo',$modelo->id));
});

Breadcrumbs::for('importarModelo', function (BreadcrumbTrail $trail) {    
    $trail->parent('modelosProgramaticos');
    $trail->push('Importar Modelos P. ', route('modelos'));
});

Breadcrumbs::for('importarActividad', function (BreadcrumbTrail $trail) {    
    $trail->parent('modelosProgramaticos');
    $trail->push('Importar Actividades ', route('modelos'));
});
Breadcrumbs::for('importarModulo', function (BreadcrumbTrail $trail) {    
    $trail->parent('modelosProgramaticos');
    $trail->push('Importar Módulos ', route('modelos'));
});
/*autor:Fabian Lopez
descripcion: Breadcrumbs para las actividades*/
Breadcrumbs::for('actividades', function (BreadcrumbTrail $trail,$modelo) {	
	$trail->parent('modelosProgramaticos');
    $trail->push('Actividad modelo '. $modelo->codigo, route('actividades',$modelo->id));
});
Breadcrumbs::for('nuevaActividades', function (BreadcrumbTrail $trail,$modelo) {	
	$trail->parent('actividades',$modelo);
    $trail->push('Nueva actividad '. $modelo->codigo, route('actividades',$modelo->id));
});

Breadcrumbs::for('editarActividades', function (BreadcrumbTrail $trail,$actividad) {	
	$trail->parent('actividades',$actividad->modeloProgramatico);
    $trail->push('Actualizar actividad '. $actividad->modeloProgramatico->codigo.''.$actividad->codigo, route('actividades',$actividad->id));
});
/*autor:Fabian Lopez
descripcion: Breadcrumbs para los modulos*/
Breadcrumbs::for('modulos', function (BreadcrumbTrail $trail,$modelo) { 
    $trail->parent('modelosProgramaticos');
    $trail->push('Módulos de '. $modelo->nombre, route('modulos',$modelo->id));
});
Breadcrumbs::for('nuevModulo', function (BreadcrumbTrail $trail,$modelo) {    
    $trail->parent('modulos',$modelo);
    $trail->push('Nuevo módulo de '. $modelo->nombre, route('modulos',$modelo->id));
});

Breadcrumbs::for('editarModulo', function (BreadcrumbTrail $trail,$modulo) {    
    $trail->parent('modulos',$modulo->modeloProgramatico);
    $trail->push('Actualizar módulo '. $modulo->modeloProgramatico->codigo.''.$modulo->codigo, route('modulos',$modulo->id));
});


/*autor:Fabian Lopez
descripcion: Breadcrumbs para tipos de participante*/
Breadcrumbs::for('tiposParticipante', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Tipos de participantes', route('tipos-participante'));
});
Breadcrumbs::for('nuevoTipoParticipante', function (BreadcrumbTrail $trail) {
    $trail->parent('tiposParticipante');
    $trail->push('Nuevo tipo de participantes', route('nuevoTipoParticipante'));
});
Breadcrumbs::for('EditarParticipante', function (BreadcrumbTrail $trail,$tipoParticipante) {
    $trail->parent('tiposParticipante');
    $trail->push('Actualizar Tipo.P '.$tipoParticipante->nombre, route('editar-participante',$tipoParticipante->id));
});
/*autor:Fabian Lopez
descripcion: Breadcrumbs para Cuentas contables*/
Breadcrumbs::for('cuentaContables', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Cuentas contables', route('cuentas-contables'));
});
Breadcrumbs::for('nuevoCuentaContable', function (BreadcrumbTrail $trail) {
    $trail->parent('cuentaContables');
    $trail->push('Nueva cuenta contable', route('nuevoCuentaContable'));
});
Breadcrumbs::for('EditarcuentaContable', function (BreadcrumbTrail $trail,$cuentaContable) {
    $trail->parent('cuentaContables');
    $trail->push('Actualizar cuenta contable', route('editar-cuenta',$cuentaContable->id));
});

/*autor:Fabian Lopez
descripcion: Breadcrumbs para materiales*/
Breadcrumbs::for('materiales', function (BreadcrumbTrail $trail) {
    $trail->parent('cuentaContables');
    $trail->push('Materiales', route('materiales'));
});
Breadcrumbs::for('nuevoMaterial', function (BreadcrumbTrail $trail) {
    $trail->parent('materiales');
    $trail->push('Nuevo material', route('nuevo-material'));
});
Breadcrumbs::for('Editarmaterial', function (BreadcrumbTrail $trail,$material) {
    $trail->parent('materiales');
    $trail->push('Actualizar material', route('editar-material',$material->id));
});

Breadcrumbs::for('importarMaterial', function (BreadcrumbTrail $trail) {
    $trail->parent('materiales');
    $trail->push('Importar material', route('importar-material'));
});
/*autor:Fabian Lopez
descripcion: Breadcrumbs para los niños*/
Breadcrumbs::for('ninios', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Participantes registrados', route('ninios'));
});

Breadcrumbs::for('niniosInformacion', function (BreadcrumbTrail $trail,$ninio) {
    $trail->parent('ninios');
    $trail->push('Información de '.$ninio->nombres, route('ninios',$ninio->id));
});

Breadcrumbs::for('nuevoNinioAfiliado', function (BreadcrumbTrail $trail,$tipoParticipante) {
    $trail->parent('ninios');
    $trail->push('Nuevo participante '.$tipoParticipante->nombres, route('nuevo-ninio',$tipoParticipante->id));
});

Breadcrumbs::for('editarNinio', function (BreadcrumbTrail $trail,$ninio) {
    $trail->parent('ninios');
    $trail->push('Actualizar '.$ninio->nombres, route('editar-ninio',$ninio->id));
});
Breadcrumbs::for('subirNinio', function (BreadcrumbTrail $trail) {
    $trail->parent('ninios');
    $trail->push('Subir participantes', route('subir-ninios'));
});
Breadcrumbs::for('qrsNinioPdfDescargar', function (BreadcrumbTrail $trail) {
    $trail->parent('ninios');
    $trail->push('Descargar qrs', route('qrsNinioPdfDescargar'));
});
Breadcrumbs::for('buzonNinio', function (BreadcrumbTrail $trail,$ninio) {
    $trail->parent('ninios');
    $trail->push('Buzón de '.$ninio->nombres, route('buzonNinio',$ninio->id));
});

// A: Deivid
// D: breadcrums para mis partcipantes de gestores en la comunidades pertenecientes y familiares
Breadcrumbs::for('misParticipantes', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Mis participantes registrados', route('misParticipantes'));
});
Breadcrumbs::for('nuevoMiParticipante', function (BreadcrumbTrail $trail,$tipoParticipante) {
    $trail->parent('misParticipantes');
    $trail->push('Nuvo participante '.$tipoParticipante->nombres, route('nuevoMiParticipante',$tipoParticipante->id));
});
Breadcrumbs::for('editarMiParticipante', function (BreadcrumbTrail $trail,$ninio) {
    $trail->parent('misParticipantes');
    $trail->push('Actualizar '.$ninio->nombres, route('editarMiParticipante',$ninio->id));
});
Breadcrumbs::for('informacionMiParticipante', function (BreadcrumbTrail $trail,$ninio) {
    $trail->parent('misParticipantes');
    $trail->push('Información de '.$ninio->nombres, route('informacionMiParticipante',$ninio->id));
});
Breadcrumbs::for('familiaMiParticipante', function (BreadcrumbTrail $trail,$ninio) {
    $trail->parent('misParticipantes');
    $trail->push('Familiares de '.$ninio->nombres, route('familiaMiParticipante',$ninio->id));
});
Breadcrumbs::for('buzonMisPartticipante', function (BreadcrumbTrail $trail,$ninio) {
    $trail->parent('misParticipantes');
    $trail->push('Buzón de '.$ninio->nombres, route('buzonMiParticipante',$ninio->id));
});
Breadcrumbs::for('crearBuzonMisPartticipante', function (BreadcrumbTrail $trail,$ninio) {
    $trail->parent('buzonMisPartticipante',$ninio);
    $trail->push('Crear cartas de '.$ninio->nombres, route('buzonMiParticipante',$ninio->id));
});
//A:Fabian Lopez 

/*autor:Fabian Lopez
descripcion: Breadcrumbs para la famila de los niños*/
Breadcrumbs::for('familiaNinios', function (BreadcrumbTrail $trail,$ninio) {
    $trail->parent('ninios');
    $trail->push('Familiares', route('familia',$ninio->id));
});
//A:Deivid
//D:Breadcrums de roles y permisos
Breadcrumbs::for('roles', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Roles', route('roles'));
});
Breadcrumbs::for('permisos', function (BreadcrumbTrail $trail,$rol) {
    $trail->parent('roles');
    $trail->push('Permisos', route('permisos',$rol->id));
});

/*autor:Fabian Lopez
descripcion: Breadcrumbs para tipos las planicacion*/
Breadcrumbs::for('planificaciones', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Planificaciones', route('planificaciones'));
});
Breadcrumbs::for('nuevaPlanificacion', function (BreadcrumbTrail $trail) {
    $trail->parent('planificaciones');
    $trail->push('Nueva Planificación', route('nueva-planificacion'));
});

Breadcrumbs::for('editarPlanificacion', function (BreadcrumbTrail $trail,$planificacion) {
    $trail->parent('planificaciones');
    $trail->push('Actualizar Planificación', route('editar-planificacion',$planificacion->id));
});

Breadcrumbs::for('planificacionesActas', function (BreadcrumbTrail $trail,$planificacion) {
    $trail->parent('planificaciones');
    $trail->push('Actividades con materiales', route('materiales-planificacion',$planificacion->id));
});

Breadcrumbs::for('Actas', function (BreadcrumbTrail $trail,$poaCuentaContableMes) {
    $trail->parent('planificacionesActas',$poaCuentaContableMes->cuentaContablePoaCuenta->poaContable->poa->planificacionModelo->planificacion);
    $trail->push('Actas Entrega Recepci{on ', route('materiales-planificacion',$poaCuentaContableMes->id));
});
Breadcrumbs::for('planificacionesExportar', function (BreadcrumbTrail $trail,$planificacion) {
    $trail->parent('planificaciones');
    $trail->push('Consulta por fechas', route('vistaExportarExcelFechas',$planificacion->id));
});
Breadcrumbs::for('planificacionesEliminarAsis', function (BreadcrumbTrail $trail,$planificacion) {
    $trail->parent('planificaciones');
    $trail->push('Eliminar Asistencias', route('listadoSinParticipacion',$planificacion->id));
});
/*autor:Fabian Lopez
descripcion: Breadcrumbs para planicacion asignar modelos programaticios*/
Breadcrumbs::for('planificaionModelos', function (BreadcrumbTrail $trail,$planificacion) {
    $trail->parent('planificaciones');
    $trail->push('Planificación de M.P ', route('planificaciones-modelo',$planificacion->id));
});

// A:Deivid
// D:actividades en poa
Breadcrumbs::for('armarPoa', function (BreadcrumbTrail $trail,$planificacionModelo) {
    $trail->parent('planificaionModelos',$planificacionModelo->planificacion);
    $trail->push('Actividades de M.P en '.Str::limit($planificacionModelo->modeloProgramatico->nombre,20,'..'), route('armarPoa',$planificacionModelo->id));
});

Breadcrumbs::for('nuevoPoaItem', function (BreadcrumbTrail $trail,$planificacionModelo) {
    $trail->parent('armarPoa',$planificacionModelo);
    $trail->push('Nueva actividad', route('nuevoPoaItem',$planificacionModelo->id));
});
Breadcrumbs::for('editarPoa', function (BreadcrumbTrail $trail,$poa) {
    $trail->parent('armarPoa',$poa->planificacionModelo);
    $trail->push('Actualizar actividad', route('editarPoa',$poa->id));
});

Breadcrumbs::for('poaActividad', function (BreadcrumbTrail $trail,$poa) {
    $trail->parent('armarPoa',$poa->planificacionModelo);
    $trail->push('N° de actividades en '.Str::limit($poa->actividad->nombre, 20,'..'), route('poaActividad',$poa->id));
});

Breadcrumbs::for('poaParticipantes', function (BreadcrumbTrail $trail,$poa) {
    $trail->parent('armarPoa',$poa->planificacionModelo);
    $trail->push('Participantes en '.Str::limit($poa->actividad->nombre, 20,'..'), route('poaParticipantes',$poa->id));
});

Breadcrumbs::for('poaCuentaContable', function (BreadcrumbTrail $trail,$poa) {
    $trail->parent('armarPoa',$poa->planificacionModelo);
    $trail->push('Cuenta contable'.Str::limit($poa->actividad->nombre, 10,'..'), route('poaCuentaContable',$poa->id));
});

Breadcrumbs::for('reportePoa', function (BreadcrumbTrail $trail,$comunidad) {
    $trail->parent('armarPoa',$comunidad->poaParticipante->poa->planificacionModelo);
    $trail->push('Reporte de '.Str::limit($comunidad->comunidad->nombre,20,'..'), route('reportesVista-poa',$comunidad->id));
});
//A:Deivid
//D:Breadcrums de usuarios
Breadcrumbs::for('usuarios', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('G. de Usuarios', route('usuarios'));
});
Breadcrumbs::for('usuariosNuevo', function (BreadcrumbTrail $trail) {
    $trail->parent('usuarios');
    $trail->push('Nuevo usuario', route('usuariosNuevo'));
});
Breadcrumbs::for('informacionUsuario', function (BreadcrumbTrail $trail,$user) {
    $trail->parent('usuarios');
    $trail->push('Información de usuario', route('informacionUsuario',$user->id));
});
Breadcrumbs::for('editarUsuario', function (BreadcrumbTrail $trail,$user) {
    $trail->parent('usuarios');
    $trail->push('Actualizar usuario', route('editarUsuario',$user->id));
});
Breadcrumbs::for('editarRolUsuario', function (BreadcrumbTrail $trail,$user) {
    $trail->parent('usuarios');
    $trail->push('Roles de usuario', route('editarRolUsuario',$user->id));
});
Breadcrumbs::for('usuariosImportar', function (BreadcrumbTrail $trail) {
    $trail->parent('usuarios');
    $trail->push('Importar usuarios', route('usuariosImportar'));
});

// coordinadores
Breadcrumbs::for('coordinadores', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Coordinadores', route('coordinadores'));
});
Breadcrumbs::for('coordinadoresNuevo', function (BreadcrumbTrail $trail) {
    $trail->parent('coordinadores');
    $trail->push('Nuevo coordinador', route('coordinadoresNuevo'));
});
Breadcrumbs::for('coordinadoresAsignarProvincia', function (BreadcrumbTrail $trail,$user) {
    $trail->parent('coordinadores');
    $trail->push('Asignar provincia', route('coordinadoresAsignarProvincia',$user->id));
});
Breadcrumbs::for('editarCoordinador', function (BreadcrumbTrail $trail,$user) {
    $trail->parent('coordinadores');
    $trail->push('Actualizar coordinador', route('editarCoordinador',$user->id));
});
// getores
Breadcrumbs::for('gestores', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Gestores', route('gestores'));
});
Breadcrumbs::for('gestoresNuevo', function (BreadcrumbTrail $trail) {
    $trail->parent('gestores');
    $trail->push('Nuevo gestor', route('gestoresNuevo'));
});
Breadcrumbs::for('editarGestor', function (BreadcrumbTrail $trail,$usuario) {
    $trail->parent('gestores');
    $trail->push('Actualizar gestor', route('editarGestor',$usuario->id));
});
// participantes
Breadcrumbs::for('participantes', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Personal SL.', route('participantes'));
});
Breadcrumbs::for('participanteNuevoAsignacion', function (BreadcrumbTrail $trail,$usuario) {
    $trail->parent('participantes');
    $trail->push('Asignar comunidades', route('participanteNuevoAsignacion',$usuario->id));
});



Breadcrumbs::for('manuales', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Manuales', route('manuales'));
});
Breadcrumbs::for('versiones', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Versiones', route('versiones'));
});






// A:Deivid
// D:Breadcrums de localidades
Breadcrumbs::for('provincias', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Provincias', route('provincias'));
});
Breadcrumbs::for('nuevaProvincia', function (BreadcrumbTrail $trail) {
    $trail->parent('provincias');
    $trail->push('Nueva provincia', route('nuevaProvincia'));
});

Breadcrumbs::for('editarProvincia', function (BreadcrumbTrail $trail,$provincia) {
    $trail->parent('provincias');
    $trail->push('Actualizar provincia', route('editarProvincia',$provincia->id));
});

// cantones
Breadcrumbs::for('cantones', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Cantones', route('cantones'));
});
Breadcrumbs::for('nuevoCanton', function (BreadcrumbTrail $trail) {
    $trail->parent('cantones');
    $trail->push('Nuevo Cantón', route('nuevoCanton'));
});
Breadcrumbs::for('editarCanton', function (BreadcrumbTrail $trail,$canton) {
    $trail->parent('cantones');
    $trail->push('Actualizar cantón', route('editarCanton',$canton->id));
});

// cantones
// en provincia
Breadcrumbs::for('cantonesEnProvincia', function (BreadcrumbTrail $trail,$provincia) {
    $trail->parent('provincias');
    $trail->push('Cantones en provincia '.$provincia->nombre, route('cantonesEnProvincia',$provincia->id));
});
Breadcrumbs::for('editarCantonEnProvincia', function (BreadcrumbTrail $trail,$canton) {
    $trail->parent('cantonesEnProvincia',$canton->provincia);
    $trail->push('Actualizar cantón', route('editarCantonEnProvincia',$canton->id));
});

// comunidaes en canton provincia
Breadcrumbs::for('coomunidadesEnCanton', function (BreadcrumbTrail $trail,$canton) {
    $trail->parent('cantonesEnProvincia',$canton->provincia);
    $trail->push('Comunidades en cantón '.$canton->nombre, route('coomunidadesEnCanton',$canton->id));
});
Breadcrumbs::for('editarComunidadEnCanton', function (BreadcrumbTrail $trail,$comunidad) {
    $trail->parent('coomunidadesEnCanton',$comunidad->canton);
    $trail->push('Actualizar comunidad ', route('editarComunidadEnCanton',$comunidad->id));
});

// solo en comunidades
Breadcrumbs::for('comunidadesSoloCanton', function (BreadcrumbTrail $trail,$canton) {
    $trail->parent('cantones',$canton->provincia);
    $trail->push('Comunidades en cantón '.$canton->nombre, route('comunidadesSoloCanton',$canton->id));
});
Breadcrumbs::for('editarComunidadEnCantonSolo', function (BreadcrumbTrail $trail,$comunidad) {
    $trail->parent('comunidadesSoloCanton',$comunidad->canton);
    $trail->push('Actualizar comunidad ', route('editarComunidadEnCantonSolo',$comunidad->id));
});

// comunidaes

Breadcrumbs::for('comunidades', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Comunidades', route('comunidades'));
});
Breadcrumbs::for('editarComunidad', function (BreadcrumbTrail $trail,$comunidad) {
    $trail->parent('comunidades');
    $trail->push('Editar comunidad', route('editarComunidad',$comunidad->id));
});
Breadcrumbs::for('importarComunidades', function (BreadcrumbTrail $trail) {
    $trail->parent('comunidades');
    $trail->push('Importar comunidades', route('importarComunidades'));
});
Breadcrumbs::for('nuevaComunidad', function (BreadcrumbTrail $trail) {
    $trail->parent('comunidades');
    $trail->push('Nueva comunidad', route('nuevaComunidad'));
});



// A:deivid
// D:breadcrums para regisrto de asistencias a actividades
Breadcrumbs::for('asistencia', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Listado de actividades', route('asistencia'));
});
Breadcrumbs::for('asistencias', function (BreadcrumbTrail $trail,$comuPoaParticipante) {
    $trail->parent('asistencia');
    $trail->push('Listado de asistencias a actividades', route('asistencias',$comuPoaParticipante->id));
});
Breadcrumbs::for('registrarAsistencia', function (BreadcrumbTrail $trail,$asistencia) {
    $trail->parent('asistencias',$asistencia->comunidadPoaParticipante);
    $trail->push('Registro asistencias a actividades', route('registrarAsistencia',$asistencia));
});


Breadcrumbs::for('misActas', function (BreadcrumbTrail $trail,$acta) {
    $trail->parent('asistencia');
    $trail->push('Mi acta', route('mi-actas',$acta->id));
});



// A:deivid
// D: gestion de archivos
Breadcrumbs::for('misArchivos', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Mis archivos', route('misArchivos'));
});

Breadcrumbs::for('nuevoArchivo', function (BreadcrumbTrail $trail) {
    $trail->parent('misArchivos');
    $trail->push('Nuevo archivo', route('nuevoArchivo'));
});

Breadcrumbs::for('listadoArchivo', function (BreadcrumbTrail $trail) {
    $trail->parent('misArchivos');
    $trail->push('Listado de archivos', route('listadoArchivo'));
});
Breadcrumbs::for('editarArchivo', function (BreadcrumbTrail $trail,$archivo) {
    $trail->parent('listadoArchivo');
    $trail->push('Actualizar archivo', route('editarArchivo',$archivo->id));
});
