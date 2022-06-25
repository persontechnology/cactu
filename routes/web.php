<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
    //subiendo cambios
    // Artisan::call('cache:clear');
    // Artisan::call('config:clear');
    // Artisan::call('config:cache');
	// Artisan::call('storage:link');
	// Artisan::call('key:generate');
	// Artisan::call('migrate:fresh --seed');
});

// terminos y condiciones
Route::get('terminos-y-condiciones', function () {
    return view('sistema.licencia');
})->name('terminosCondiciones');

Route::namespace('Buzon')->group(function () {
    // roles
    Route::get('/mi-buzon/{token}', 'Buzones@index')->name('entrada');
    Route::get('/mis-cartas-buzon/{token}', 'Buzones@buzon')->name('misCartasBuzon');
    Route::get('/mis-cartas-respuesta/{id}/{token}', 'Buzones@respuestaCarta')->name('misCartasRespuestas');
    Route::post('/registro-de-imagen-carta', 'Buzones@guardarImagenUno')->name('registroImagenUno');
    Route::post('/registro-de-premayo-carta', 'Buzones@responderPreMayores')->name('registroPerMayosUno');
    Route::post('/registro-de-otras-cartas', 'Buzones@responderOtrasCartas')->name('registroDeotrasCartas');
    Route::post('/guardar-mensaje-ninio', 'Buzones@guardarMesaje')->name('guardarMensajeNinio');
});

// rutas verificadas por correos electronicos
Auth::routes(['verify' => true,'register' => false]);
Route::middleware(['verified', 'auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

 
    Route::get('/mi-perfil', 'HomeController@miPerfil')->name('miPerfil');
    Route::post('/mi-perfil-actualizar', 'HomeController@miPerfilActualizar')->name('actualizarMiPerfil');
    
    

    // soporte de sistema del sistema 
    Route::get('/soporte', 'HomeController@soporte')->name('soporte');

    /*consultar datos de niño*/
    Route::post('/dato-ninio', 'HomeController@datoNinio')->name('datoNinio');    

    /*autor: Fabian Lopez
    descripcion:rutas para modelos programaticos*/
    Route::get('/modelos', 'ModelosProgramaticos@index')->name('modelos');
    Route::get('/nuevo-modelo', 'ModelosProgramaticos@nuevo')->name('nuevo-modelo');
    Route::post('/guardar-modelo', 'ModelosProgramaticos@guardar')->name('guardar-modelo');
    Route::get('/editar-modelo/{id}', 'ModelosProgramaticos@editar')->name('editar-modelo');
    Route::post('/actualizar-modelo', 'ModelosProgramaticos@actualizar')->name('actualizar-modelo');
    Route::post('/modelo-eliminar', 'ModelosProgramaticos@eliminar')->name('eliminar-modelo');

    Route::get('/modelosImportar', 'ModelosProgramaticos@importarModelo')->name('modelosImportar');
    Route::post('/modelos-procesar-importar', 'ModelosProgramaticos@procesarImportacionModelo')->name('procesarImportacionModelos');

     Route::get('/actividadImportar', 'ModelosProgramaticos@importarActividad')->name('actividadImportar');
    Route::post('/actividad-procesar-importar', 'ModelosProgramaticos@procesarImportacionActividad')->name('procesarImportacionActividad');

     Route::get('/moduloImportar', 'ModelosProgramaticos@importarModulo')->name('moduloImportar');
    Route::post('/modulo-procesar-importar', 'ModelosProgramaticos@procesarImportacionModulo')->name('procesarImportacionModulo');
    /*autor: Fabian Lopez
    descripcion:rutas para las actividades*/
    Route::get('/actividades/{id}', 'Actividades@index')->name('actividades');
    Route::get('/nueva-actividad/{id}', 'Actividades@nuevo')->name('nueva-actividad');
    Route::post('/guardar-actividad', 'Actividades@guardar')->name('guardar-actividad');
     Route::get('/editar-actividad/{id}', 'Actividades@editar')->name('editar-actividad');
    Route::post('/actualizar-actividad', 'Actividades@actualizar')->name('actualizar-actividad');
    Route::post('/actividad-eliminar', 'Actividades@eliminar')->name('eliminar-actividad');

     /*autor: Fabian Lopez
    descripcion:rutas para los modulos*/
    Route::get('/modulos/{id}', 'Modulos@index')->name('modulos');
    Route::get('/nueva-modulo/{id}', 'Modulos@nuevo')->name('nueva-modulo');
    Route::post('/guardar-modulo', 'Modulos@guardar')->name('guardar-modulo');
     Route::get('/editar-modulo/{id}', 'Modulos@editar')->name('editar-modulo');
    Route::post('/actualizar-modulo', 'Modulos@actualizar')->name('actualizar-modulo');
    Route::post('/modulo-eliminar', 'Modulos@eliminar')->name('eliminar-modulo');

    /*autor: Fabian Lopez
    descripcion:rutas para modelos tipos de participante*/
    Route::get('/tipos-participante', 'TipoParticipantes@index')->name('tipos-participante');
    Route::get('/tipos-participante-nuevo', 'TipoParticipantes@nuevo')->name('nuevoTipoParticipante');
    Route::post('/guardar-participante', 'TipoParticipantes@guardar')->name('guardar-participante');
    Route::get('/editar-participante/{id}', 'TipoParticipantes@editar')->name('editar-participante');
    Route::post('/actualizar-participante', 'TipoParticipantes@actualizar')->name('actualizar-participante');
    Route::post('/participante-eliminar', 'TipoParticipantes@eliminar')->name('eliminar-participante');

    /*autor: Fabian Lopez
    descripcion:rutas para cuentas contables*/
    Route::get('/cuentas-contables', 'CuentasContables@index')->name('cuentas-contables');
    Route::get('/cuentas-contables-nuevo', 'CuentasContables@nuevo')->name('nuevoCuentaContable');
    Route::post('/guardar-cuenta', 'CuentasContables@guardar')->name('guardar-cuenta');
    Route::get('/editar-cuenta/{id}', 'CuentasContables@editar')->name('editar-cuenta');
    Route::post('/actualizar-cuenta', 'CuentasContables@actualizar')->name('actualizar-cuenta');
    Route::post('/-eliminarcuenta', 'CuentasContables@eliminar')->name('eliminar-cuenta');
    //Materiales
    Route::get('/materiales', 'Materiales@index')->name('materiales');
    Route::get('/material-nuevo', 'Materiales@nuevo')->name('nuevo-material');
    Route::post('/guardar-materiale', 'Materiales@guardar')->name('guardar-material');
    Route::get('/editar-materiale/{id}', 'Materiales@editar')->name('editar-material');
    Route::post('/actualizar-materiale', 'Materiales@actualizar')->name('actualizar-material');
    Route::post('/-eliminarmateriale', 'Materiales@eliminar')->name('eliminar-material');
    Route::post('/guardar-post-materiale', 'Materiales@guardarPost')->name('guardar-post-material');
    
    Route::get('/importar-material', 'Materiales@importarMaterial')->name('importar-material');
    Route::post('/importar-material-guardar', 'Materiales@importarArchivo')->name('importar-material-guardar');
    
    
    // importarArchivo
   
    //A:Fabian Lopez
    //D:rutaas para verificar las actas de entrega recepcion 
    Route::get('/nuevo-materiale/{id}', 'Actas@acta')->name('acta-material');
    Route::get('/materiales-planificacion/{id}', 'Actas@buscarActividadesMateriales')->name('materiales-planificacion');
    Route::post('/buscarLike-materiale', 'Actas@buscarLikeMateriales')->name('buscarMateriales-material');
    Route::post('/guardar-acta', 'Actas@guardarActasMateriales')->name('guardar-acta');
    Route::get('/listado-materiale/{idMes}/{idComunidad}', 'Actas@listaMateriales')->name('listados-material');
    Route::post('/eliminar-materila-acta', 'Actas@borrarActaMaerial')->name('eliminar-material-acta');
    Route::post('/cambiar-estado-acta', 'Actas@cambiarEstadoActa')->name('cambiar-estado-acta');
    Route::get('/respaldo-acta', 'Actas@respaldoCactuActa')->name('respaldo-actas');
    Route::get('/mi-acta/{id}', 'Actas@miActa')->name('mi-actas');
    Route::get('/mi-termino', 'Actas@terminos')->name('mi-termino');
    Route::get('/exportar-pdf/{id}', 'Actas@exportarActa')->name('exportar-pdf');

    
    Route::post('/cambiar-estado-acta-aceptado', 'Actas@cambiarEstadoActaAceptada')->name('cambiar-estado-acta-aceptada');
    
    
    
    /*autor: Fabian Lopez
    descripcion:rutas para niños*/
    Route::get('/ninios', 'Ninios@index')->name('ninios');
    Route::get('/subir-ninios', 'Ninios@subirNinios')->name('subir-ninios');
    Route::post('/importar-archivo', 'Ninios@importarArchivo')->name('importar-archivo');
    Route::get('/ninio-informacion/{id}', 'Ninios@informacion')->name('ninio-informacion');
    Route::get('/nuevo-ninio/{id}', 'Ninios@nuevoAfialiado')->name('nuevo-ninio');
    Route::post('/guardar-ninioAfiliado', 'Ninios@guardarNinioafilia')->name('guardar-ninioAfiliado');
    Route::post('/guardar-ninio', 'Ninios@guardarNinio')->name('guardar-ninio');
    Route::get('/editar-ninio/{id}', 'Ninios@editarNinio')->name('editar-ninio');
    Route::post('/actualizar-ninio', 'Ninios@actualizarNinio')->name('actualizar-ninio');
    Route::get('/descargar-codigos-qrs-x-comunidad', 'Ninios@descargarQrs')->name('qrsNinioPdfDescargar');
    Route::get('/qr-ninio/{idNinio}', 'Ninios@qr')->name('qrNinio');
    Route::get('/qr-ninios-pdf/{comunidad}', 'Ninios@qrPdf')->name('qrsNinioPdf');

    Route::get('/ninios-pdf/{id}', 'Ninios@ninioInformacionPdf')->name('ninioInformacionPdf');
    Route::get('/ninios-imprimir/{id}', 'Ninios@ninioInformacionImprimir')->name('ninioInformacionImprimir');
    Route::post('/eliminar-ninio', 'Ninios@eliminarNinio')->name('eliminar-ninio');
    Route::get('/numero-ninios', 'Ninios@numeroNinos')->name('numeroNinios');
    
    Route::post('/subir-numer-ninio', 'Ninios@subirNumeros')->name('subir-numero-ninio');

    
    
    //A:Fabian
    //D: consulta para verificar el numero de asistencias por niño
    Route::post('/consultar-asistencias-ninio', 'Ninios@consultaNinio')->name('consultar-asistencias-ninio');

     /*
            *Nuevas rutas para subir archivos en la carpeta digital en cada participante en nuevo commit
        */
    Route::post('/buscar-archivo-par', 'Ninios@buscarNinioArchivos')->name('buscararchivoPart');
    Route::post('/guargar-archivo-par', 'Ninios@creaArchiivoCarpeta')->name('guarararchivoPart');
    Route::post('/actualizar-archivo-par', 'Ninios@actualizarCarpeta')->name('actualizararchivoPart');
    Route::post('/eliminar-archivo-par', 'Ninios@eliminarCarpeta')->name('eliminararchivoPart');
    Route::get('/enlistar-files', 'Ninios@buscarFiles')->name('enlistraFiles');
    Route::get('/ninio-buzon/{ninio}', 'Ninios@buzon')->name('buzonNinio');
    Route::get('/ver-carta-pdf-ninio/{id}', 'Ninios@vistaCarta')->name('vistaCartaPdfNinio');
     Route::get('/ver-mi-respuesta-ninio-pdf/{id}', 'Ninios@exportarCartasPdf')->name('repuestaCartaPdfNinio');
      /*
      *Descripcion: en estas funciones seran implementadas para el modulo de mensajería
      *Autor:Fabian López
      *Fecha Junio 2020
    */
    Route::get('/actualizar-datos-buzon', 'Ninios@actualizarDoto')->name('actualizarDatosBuzon');
    /*autor: Fabian Lopez
    descripcion:rutas para la familia del ninio*/

    Route::get('/familia/{id}', 'Familias@index')->name('familia');
    Route::post('/guardar-familia', 'Familias@guardar')->name('guardar-familia');


    // A:Deivid
    // D: gestion de participantes pertenecientes al gestor relacionado a la comunidad
    Route::get('/mis-participantes', 'Misparticipantes@index')->name('misParticipantes');
    Route::get('/mis-participantes-editar/{id}', 'Misparticipantes@editar')->name('editarMiParticipante');
    Route::post('/mis-participantes-actualizar', 'Misparticipantes@actualizar')->name('actualizarMiParticipante');
    Route::post('/mis-participantes-eliminar', 'Misparticipantes@eliminar')->name('eliminarMiParticipante');
    Route::get('/mis-participantes-informacion/{id}', 'Misparticipantes@informacion')->name('informacionMiParticipante');
    Route::get('/mis-participantes-informacion-pdf/{id}', 'Misparticipantes@informacionPdf')->name('informacionPdfMiParticipante');
    Route::get('/mis-participantes-nuevo/{tipoParticipante}', 'Misparticipantes@nuevo')->name('nuevoMiParticipante');
    Route::post('/mis-participantes-guardar', 'Misparticipantes@guardarAfiliado')->name('guardarMiParticipanteAfiliado');
    // familia
    Route::get('/mis-participantes-familia/{ninio}', 'Misparticipantes@familia')->name('familiaMiParticipante');
    Route::post('/mis-participantes-familia-guardar', 'Misparticipantes@familiaGuardar')->name('guardarFamiliaMiParticipantes');
    

  /*
      *Descripcion: la rutas seran implementadas para el modulo de mensajería
      *Autor:Fabian López
      *Fecha Junio 2020
    */
    Route::get('/mis-participantes-buzon/{ninio}', 'Misparticipantes@buzon')->name('buzonMiParticipante');
    Route::get('/crear-buzon-participante/{ninio}', 'Misparticipantes@nuevoBuzonParticipante')->name('crearBuzonParticipante');
    Route::post('/buscar-cartas-nuevo', 'Misparticipantes@buscarCartasNuevo')->name('bucarCargasNuevo');
    Route::post('/crear-cartas-nuevo', 'Misparticipantes@crearCartasNuevo')->name('crearCartaNuevo');
    Route::post('/actualizar-cartas-boleta', 'Misparticipantes@actualizarBoleta')->name('actualizarCartaBoleta');
    Route::post('/buscar-cartas-boleta', 'Misparticipantes@buscarBoleta')->name('buscarCartaBoleta');
    
    
    Route::post('/actualizar-cartas-archivo', 'Misparticipantes@actualizarRchivoCarta')->name('actualizarCartaArchivo');
    Route::post('/eliminar-cartas-boleta', 'Misparticipantes@eliminarBoleta')->name('eliminarCartaBoleta');
    Route::post('/eliminar-cartas-pdf', 'Misparticipantes@eliminarCartaPdf')->name('eliminarCartapdf');
    Route::post('/enviar-cartas-pdf', 'Misparticipantes@enviarCarta')->name('enviarCartapdf');
    Route::post('/eliminar-cartas-total', 'Misparticipantes@eliminarCartaTotal')->name('eliminarCartatotal');
    Route::get('/ver-carta-pdf/{id}', 'Misparticipantes@vistaCarta')->name('vistaCartaPdf');
    
    Route::get('/ver-mi-respuesta-pdf/{id}', 'Misparticipantes@exportarCartasPdf')->name('repuestaCartaPdf');
    Route::post('/buscar-mensajes', 'Misparticipantes@buscarMensajes')->name('buscarMesajes');
 
    
    
    Route::get('/qr-ninio-partiipante/{idNinio}', 'Misparticipantes@qr')->name('qrNinioParticipante');

        /*
            *Nuevas rutas para subir archivos en la carpeta digital en cada participante en nuevo commit
        */
        Route::post('/buscar-archivo-participante', 'Misparticipantes@buscarNinioArchivos')->name('buscararchivoParticipante');
        Route::post('/guargar-archivo-participante', 'Misparticipantes@creaArchiivoCarpeta')->name('guarararchivoParticipante');
        Route::post('/actualizar-archivo-participante', 'Misparticipantes@actualizarCarpeta')->name('actualizararchivoParticipante');
        Route::post('/eliminar-archivo-participante', 'Misparticipantes@eliminarCarpeta')->name('eliminararchivoParticipante');
    // sistema
    //A:Deivid
    //D. roles y permisos de sistema solo acesso Administrador

    Route::namespace('Sistema')->group(function () {
        // roles
        Route::get('/roles', 'Roles@index')->name('roles');
        Route::post('/roles-guardar', 'Roles@guardar')->name('guardarRol');
        Route::post('/roles-eliminar', 'Roles@eliminar')->name('eliminarRol');
        // permisos
        Route::get('/permisos/{idRol}', 'Permisos@index')->name('permisos');
        Route::post('/permisos-sincronizar', 'Permisos@sincronizar')->name('sincronizarPermiso');
    });


    // A:Deivid
    // D:Ingres de usuarios"
    Route::namespace('Usuario')->group(function () {
        // Usuarios
        Route::get('/usuarios', 'Usuarios@index')->name('usuarios');
        Route::get('/usuarios-nuevo', 'Usuarios@nuevo')->name('usuariosNuevo');
        Route::post('/usuarios-guardar', 'Usuarios@guardar')->name('guardarUsuario');
        Route::post('/usuarios-eliminar', 'Usuarios@eliminar')->name('eliminarUsuario');
        Route::get('/usuarios-editar-rol/{idUsuario}', 'Usuarios@editarRol')->name('editarRolUsuario');
        Route::post('/usuarios-actualizar-roles', 'Usuarios@actualizarRolUsuario')->name('actualizarRolUsuario');
        Route::get('/usuarios-editar/{idUsuario}', 'Usuarios@editar')->name('editarUsuario');
        Route::post('/usuarios-actualizar', 'Usuarios@actualizar')->name('actualizarUsuario');
        Route::get('/usuarios-informacion/{idUsuario}', 'Usuarios@informacion')->name('informacionUsuario');
        Route::get('/usuarios-rol/{nombreRol}', 'Usuarios@usuariosPoRol')->name('usuariosPoRol');
        Route::get('/usuarios-informacion-pdf/{idUsuario}', 'Usuarios@informacionPdf')->name('usuarioInformacionPdf');
        Route::get('/usuarios-informacion-imprimir/{idUsuario}', 'Usuarios@informacionImprimir')->name('usuarioInformacionImprimir');
        Route::get('/usuarios-importar', 'Usuarios@importar')->name('usuariosImportar');
        Route::post('/usuarios-procesar-importar', 'Usuarios@procesarImportacion')->name('procesarImportacionUsuarios');
        Route::get('/usuario-firma/{user}', 'Usuarios@firma')->name('firmaUsuario');
        Route::post('/usuario-firma-procesar', 'Usuarios@procesarFirma')->name('procesarFirma');
        
        
        

        // coordinadores
        Route::get('/coordinadores', 'Coordinadores@index')->name('coordinadores');
        Route::get('/coordinadores-nuevo', 'Coordinadores@nuevo')->name('coordinadoresNuevo');
        Route::post('/coordinadores-guardar', 'Coordinadores@guardar')->name('guardarCoordinador');
        Route::get('/coordinadores-asignar-provincias/{idUsuario}', 'Coordinadores@asignarProvincias')->name('coordinadoresAsignarProvincia');
        Route::post('/coordinadores-asignar-provincias-actualizar', 'Coordinadores@actualizarAsignacionProvincia')->name('coordinadorActualizarAsignacionProvincia');
        Route::get('/coordinadores-editar/{idUsuario}', 'Coordinadores@editar')->name('editarCoordinador');
        Route::post('/coordinadores-actualizar', 'Coordinadores@actualizar')->name('actualizarCoordinador');
        Route::post('/coordinador-eliminar', 'Coordinadores@eliminar')->name('eliminarCoordinador');
        
        //gestores       
        Route::get('/gestores', 'Gestores@index')->name('gestores');
        Route::get('/gestores-nuevo', 'Gestores@nuevo')->name('gestoresNuevo');
        Route::post('/gestores-guardar', 'Gestores@guardar')->name('guardarGestor');
        Route::get('/gestores-editar/{idUsuario}', 'Gestores@editar')->name('editarGestor');
        Route::post('/gestores-actualizar', 'Gestores@actualizar')->name('actualizarGestor');
        Route::post('/gestores-eliminar', 'Gestores@eliminar')->name('eliminarGestor');


        // participantes
        Route::get('/participantes', 'Participantes@index')->name('participantes');
        Route::get('/participantes-nuevo-asignacion/{idUsuario}', 'Participantes@asignacion')->name('participanteNuevoAsignacion');
        Route::post('/participantes-asignar-comunidades', 'Participantes@asignarComunidades')->name('asignarComunidadesParticipante');
        
       
    });


    // A:Deivid
    // D: Localidades quienes tengan permiso "G. de comunidades"
    Route::namespace('Localidad')->group(function () {
        // provincias
        Route::get('/provincias', 'Provincias@index')->name('provincias');
        Route::get('/provincias-nuevo', 'Provincias@nuevo')->name('nuevaProvincia');
        Route::post('/provincias-guardar', 'Provincias@guardar')->name('guardarProvincia');
        Route::get('/provincias-editar/{idProvincia}', 'Provincias@editar')->name('editarProvincia');
        Route::post('/provincias-actualizar', 'Provincias@actualizar')->name('actualizarProvincia');
        Route::post('/provincias-eliminar', 'Provincias@eliminar')->name('eliminarProvincia');

        
        // cantones
        Route::get('/cantones', 'Cantones@index')->name('cantones');
        Route::get('/cantones-nuevo', 'Cantones@nuevo')->name('nuevoCanton');
        Route::post('/cantones-guardar', 'Cantones@guardar')->name('cantonesGuardar');
        Route::get('/cantones-editar/{idCanton}', 'Cantones@editar')->name('editarCanton');
        Route::post('/cantones-actualizar', 'Cantones@actualizar')->name('actualizarCanton');
        

        // cantones
        // en provincia
        Route::get('/cantones-en-provincia/{idProvincia}', 'Cantones@cantonesEnProvincia')->name('cantonesEnProvincia');
        Route::post('/cantones-eliminar', 'Cantones@eliminar')->name('eliminarCanton');
        Route::get('/cantones-editar-en-provincia/{idCanton}', 'Cantones@editarCantonEnProvincia')->name('editarCantonEnProvincia');
        Route::post('/cantones-actualizar-en-provincia', 'Cantones@actualizarCantonEnProvincia')->name('actualizarCantonEnProvincia');


        // comunidades
        // en canton
        Route::get('/comunidades-en-canton/{idCanton}', 'Comunidades@comunidadesEnCanton')->name('coomunidadesEnCanton');
        Route::post('/comunidades-eliminar', 'Comunidades@eliminar')->name('eliminarComunidad');
        Route::get('/comunidades-en-canton-editar/{idComunidad}', 'Comunidades@editarComunidadEnCanton')->name('editarComunidadEnCanton');
        Route::post('/comunidades-en-canton-actualizar', 'Comunidades@actualizarcomunidadEnCanton')->name('actualizarcomunidadEnCanton');
        // en solo canton
        Route::get('/comunidades-canton/{idCanton}', 'Comunidades@comunidadesSoloCanton')->name('comunidadesSoloCanton');
        Route::get('/comunidades-canton-editar/{idCanton}', 'Comunidades@editarComunidadEnCantonSolo')->name('editarComunidadEnCantonSolo');
        Route::post('/comunidades-canton-actualizar', 'Comunidades@actualizarcomunidadEnCantonSolo')->name('actualizarcomunidadEnCantonSolo');
        
        // solo en comunidades
        Route::get('/comunidades', 'Comunidades@index')->name('comunidades');
        Route::post('/comunidades-guardar', 'Comunidades@guardar')->name('guardarCoomunidad');
        Route::get('/comunidades-editar/{idComunidad}', 'Comunidades@editar')->name('editarComunidad');
        Route::post('/comunidades-actualizar', 'Comunidades@actualizar')->name('actualizarComunidad');
        Route::get('/comunidades-importar', 'Comunidades@importar')->name('importarComunidades');
        Route::post('/comunidades-importar-procesar', 'Comunidades@procesarImportacion')->name('procesarImportacionComunidades');
        Route::get('/comunidades-nuevo', 'Comunidades@nuevo')->name('nuevaComunidad');
        
    });


    // A:Deivid
    // D:planificaciones
    //editado por fabian lopez
    Route::get('/planificaciones', 'Planificaciones@index')->name('planificaciones');
    Route::get('/nueva-planificacion', 'Planificaciones@nueva')->name('nueva-planificacion');
    Route::post('/guardar-planificacion', 'Planificaciones@guardar')->name('guardar-planificacion');
    Route::get('/editar-planificacion/{id}', 'Planificaciones@editar')->name('editar-planificacion');
    Route::post('/actualizar-planificacion', 'Planificaciones@actualizar')->name('actualizar-planificacion');
    Route::post('/eliminar-planificacion', 'Planificaciones@eliminarPlanificacion')->name('eliminar-planificacion');
    
    
     // A:Fabian Lopez
    // D:planificacion modelo programatico dentreo de planificaciones
    Route::get('/planificaciones-modelo/{id}', 'Planificaciones@modeloProgramatico')->name('planificaciones-modelo');
    Route::post('/asignar-modelo', 'Planificaciones@asignarModeloProgramatico')->name('asignar-modelo');
    Route::post('/elimminar-asignarmodelo', 'Planificaciones@eliminnarModeloProgramatico')->name('elimminar-asignarmodelo');

    // A:Fabian
    // D:Manuales
    Route::get('/manuales', 'Manuales@index')->name('manuales');
    Route::get('/versiones', 'Manuales@versiones')->name('versiones');
   
    // A:DEIVID
    //D: ARMAR POA
    
    Route::namespace('Poas')->group(function () {
        // poas
        Route::get('/armar-poa/{planificacionModeloId}', 'Poas@index')->name('armarPoa');
        Route::get('/armar-poa-nuevo/{planificacionModeloId}', 'Poas@nuevo')->name('nuevoPoaItem');
        Route::post('/armar-poa-guardar', 'Poas@guardar')->name('guardarPoaItem');
        Route::post('/eliminar-poa', 'Poas@eliminarPoa')->name('eliminar-poa');
        Route::get('/editar-poa/{poa}', 'Poas@editarPoa')->name('editarPoa');
        Route::post('/armar-poa-actualizar', 'Poas@actualizarPoaItem')->name('actualizarPoaItem');
        
        

        //reporte de poas 
        Route::get('/reportesVista-poa/{idComunidadPoaParticipante}', 'Poas@reportesVista')->name('reportesVista-poa');

        
        // POA ACTIVIDAD
        Route::get('/poa-actividad/{idPoa}', 'PoaActividades@index')->name('poaActividad');
        Route::post('/poa-actividad-guardar', 'PoaActividades@guardar')->name('poaActividadGuardar');
        Route::post('/poa-actividad-actualizar-valor-mes', 'PoaActividades@actualizarValorMes')->name('actualizarValorMesPoaActividad');

        // POA PARTICIPANTE
        Route::get('/poa-participantes/{idPoa}', 'PoaParticipantes@index')->name('poaParticipantes');
        Route::post('/poa-participantes-actualizar', 'PoaParticipantes@actualizar')->name('actualizarPoaParticipante');
        Route::post('/poa-participantes-actualizar-comunidades', 'PoaParticipantes@actualizarComunidades')->name('actualizarPoaParticipanteComunidades');
        Route::post('/poa-participantes-actualizar-tipo-participantes', 'PoaParticipantes@actualizarTipoParticipantes')->name('actualizarPoaParticipanteTipoParticipante');
        Route::post('/poa-participantes-actualizar-coordinador', 'PoaParticipantes@actualizarCoordinador')->name('actualizarPoaParticipanteCoordinador');
        Route::post('/poa-participantes-actualizar-valor-mes', 'PoaParticipantes@actualizarValorMes')->name('actualizarValorMesPoaParticipante');
        

         // POA cuentas contables
        Route::get('/poa-cuentaContable/{idPoa}', 'PoaCuentasContables@index')->name('poaCuentaContable');
        Route::post('/poa-cuenta-actualizar', 'PoaCuentasContables@actualizar')->name('actualizarPoaCuenta');
        Route::post('/poa-cuenta-actualizar-ceuntas', 'PoaCuentasContables@actualizarCuentasContables')->name('actualizarPoaContbleCunetasContables');
        Route::post('/poa-cuenta-actualizar-valor-mes', 'PoaCuentasContables@actualizarValorMes')->name('actualizarValorMesPoaCuenta');
        Route::post('/poa-cuenta-eliminar-valor-mes', 'PoaCuentasContables@eliminarMeses')->name('eliminarValorMesPoaCuenta');
         
       // Route::post('/poa-cuentaContable-guardar', 'PoaCuentasContables@guardar')->name('poaCuentaContableGuardar');        

    });

    Route::namespace('Registros')->group(function () {
        Route::get('/listado-de-actividades', 'Asistencias@index')->name('asistencia');
        Route::get('/lista-de-asistencias/{idComunidadPoaParticipante}', 'Asistencias@asistencias')->name('asistencias');
        Route::post('/registro-de-asistencia-a-actividad-crear', 'Asistencias@crear')->name('crearAsistencia');
        Route::get('/registrar-asistencia-a-actividad/{idAsistencia}', 'Asistencias@registrar')->name('registrarAsistencia');
        Route::post('/registro-de-asistencia-a-actividad-guardar', 'Asistencias@guardar')->name('guardarAsistencia');
        Route::get('/cargar-listado-de-asistecia/{idAsis}', 'Asistencias@cargaListado')->name('cargaListado');        
        Route::post('/actualizar-cuentables-de-listado', 'Asistencias@actualiuzarCuentasContablesLista')->name('actualiuzarCuentasContablesLista');
        Route::post('/actualizar-opcion-de-listado', 'Asistencias@actualizarOpcionLista')->name('actualizarOpcionLista');
        Route::post('/actualizar-detalle-de-asistencia', 'Asistencias@actualizarDetalleAsistencia')->name('actualizarDetalleAsistencia');
        Route::get('/exportar-pdf-asistencia/{idAsis}', 'Asistencias@exportarPdf')->name('exportarPdfAsistencia');
        Route::get('/exportar-excel-asistencia/{idAsis}', 'Asistencias@exportarExcel')->name('exportarExcel');
        
        /*
        * Autor:Fabian Lopesz
        *Descripción: En estas rutas se reialza las consultas para el numero de asistencias creadas sin participación
        * Por otra parte las otras rutas permiten buscar el numero de asistencias por fecha
        *Tener en cuenta que para esto funcioe verificar las rutas controladores y vitas
        */
        // Route::get('listado-sin-participacion/{id}', 'Asistencias@eliminarSinParticipantes')->name('listadoSinParticipacion');
        // Route::post('eliminar-sin-participacion','Asistencias@eliminarAsistencias')->name('eliminarSinParticipacion');
        // Route::get('listado-eliminar/{id}', 'Asistencias@listadoEliminar')->name('listadoEliminarParticipacion');
        // Route::get('exportar-excel-fechas/{id}', 'Asistencias@vistaExportarExcelFechas')->name('vistaExportarExcelFechas');
        
        // Route::post('listado-excel-fechas', 'Asistencias@exportarExcelFechas')->name('listadoExportarExcelFechas');
        
        /*
        * FIN DE LOS REQUERIMIENTOS PARA ELIMINAR Y BUSCAR POR FECHAS
        */
        
        
    });



    // @:deivid
    // d: gestion de mis archivos
    Route::get('/mis-archivos', 'Archivos@index')->name('misArchivos');
    Route::get('/archivos-nuevo', 'Archivos@nuevo')->name('nuevoArchivo');
    Route::post('/archivos-guardar', 'Archivos@guardar')->name('guardarArchivo');
    Route::get('/archivos-editar/{id}', 'Archivos@editar')->name('editarArchivo');
    Route::post('/archivos-actualizar', 'Archivos@actualizar')->name('actualizarArchivo');
    Route::get('/archivos-listado', 'Archivos@listado')->name('listadoArchivo');
    Route::post('/archivos-eliminar', 'Archivos@eliminar')->name('eliminarArchivo');


});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
