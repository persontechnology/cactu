@extends('layouts.app',['title'=>'Versiones'])

@section('breadcrumbs', Breadcrumbs::render('versiones'))

@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Versión 1.0</h5>            
        Última actualización 14,sep,2020
    </div>  
<div class="card-body">
    <table class="table table-bordered">
        <thead>
            <tr >
                <td >
                <p ><span >Módulos </span></p>
                </td>
                <td >
                <p ><span >Funcionalidades </span></p>
                </td>
            </tr>
        </thead>
        <tbody>
        
        <tr >
        <td >
        <p><span ><span >Gestión de roles y permisos </span></span></p>
        </td>
        <td >
        <p><span ><span ><span >Crear, actualizar y eliminar para identificar que tipo de usuario ha iniciado sesión y de esta forma elegir a donde llevarlo, qu&eacute; mostrarle, qu&eacute; puede y no hacer.</span></span></span></p>
        </td>
        </tr>
        <tr >
        <td >
        <p><span >Gestión de usuario</span></p>
        </td>
        <td >
        <ul>
        <li>
        <p><span ><span ><span >Crear, actualizar,</span></span></span> <span ><span ><span >eliminar, </span></span></span><span ><span ><span > cambio de estado (Activo e Inactivo), </span></span></span><span ><span ><span >importación de datos </span></span></span><span ><span ><span >.</span></span></span></p>
        </li>
        <li>
        <p><span ><span ><span >Asignar rol para el sistema (Gestor, Coordinador, Administrador)</span></span></span></p>
        </li>
        </ul>
        <p>&nbsp;</p>
        </td>
        </tr>
        <tr >
        <td >
        <p><span >Firma electrónica </span></p>
        </td>
        <td >
        <ul>
        <li>
        <p>Guardar la firma digital de cada usuario para los posibles tramites</p>
        </li>
        </ul>
        </td>
        </tr>
        <tr >
        <td >
        <p><span >Gestión de localidades </span></p>
        </td>
        <td >
        <p ><span ><span ><span >Crear, actualizar,</span></span> <span ><span >eliminar </span></span><span ><span >e importación de datos</span></span> <span ><span >(Provincia, Cantón, Comunidad), hay que recordar que cada usuario o niño pertenece a una comunidad.</span></span></span></p>
        </td>
        </tr>
        <tr >
        <td >
        <p><span >Gestión de modelos programáticos, actividades y módulos </span></p>
        </td>
        <td >
        <p ><span ><span ><span >Crear, actualizar,</span></span> <span ><span >eliminar </span></span><span ><span >e importación de datos, se debe recordar que cada modelo programático de</span></span><span ><span >be</span></span><span ><span > tener su administración de actividades y módulos </span></span> </span></p>
        </td>
        </tr>
        <tr >
        <td >
        <p><span >Gestión de tipos de participantes </span></p>
        </td>
        <td >
        <p ><span ><span ><span >Crear, actualizar </span></span><span ><span >y</span></span> <span ><span >eliminar</span></span></span></p>
        </td>
        </tr>
        <tr >
        <td >
        <p ><span ><span ><span >Gestión de </span></span><span ><span >cuentas contables </span></span></span></p>
        </td>
        <td >
        <p ><span ><span ><span >Crear, actualizar </span></span><span ><span >y</span></span> <span ><span >eliminar, </span></span><span ><span >esto se aplica para las que son diferentes de Materiales</span></span></span></p>
        </td>
        </tr>
        <tr >
        <td >
        <p><span >Gestión de Materiales</span></p>
        </td>
        <td >
        <p ><span ><span ><span >Crear, actualizar,</span></span> <span ><span >eliminar </span></span><span ><span >e importación de datos, </span></span><span ><span >dentro de las cuentas contables tenemos materiales es all&iacute; donde se realiza esta gestión los cuales nos ayudara en el modulo de Actas </span></span></span></p>
        </td>
        </tr>
        <tr >
        <td >
        <p><span >Niños o Participantes </span></p>
        </td>
        <td >
        <ul>
        <li>
        <p><span >Crear</span></p>
        </li>
        <li>
        <p><span >Actualizar </span></p>
        </li>
        <li>
        <p><span >Eliminar</span></p>
        </li>
        <li>
        <p><span >Importar datos </span></p>
        </li>
        <li>
        <p><span >Crear familia </span></p>
        </li>
        <li>
        <p><span >Geolocalización de su vivienda </span></p>
        </li>
        <li>
        <p><span >Asignación de código Qr</span></p>
        </li>
        <li>
        <p><span >Vista previa de sus datos</span></p>
        </li>
        <li>
        <p><span >Vista de las recientes participaciones </span></p>
        </li>
        <li>
        <p><span >Vista de los archivos </span></p>
        </li>
        <li>
        <p><span >vista de su buzón </span></p>
        </li>
        </ul>
        </td>
        </tr>
        <tr >
        <td >
        <p><span >Gestión de Mis participantes </span></p>
        </td>
        <td >
        <ul>
        <li>
        <p><span >Crear</span></p>
        </li>
        <li>
        <p><span >Actualizar </span></p>
        </li>
        <li>
        <p><span >Eliminar</span></p>
        </li>
        <li>
        <p><span >Importar datos </span></p>
        </li>
        <li>
        <p><span >Crear familia </span></p>
        </li>
        <li>
        <p><span >Geolocalización de su vivienda </span></p>
        </li>
        <li>
        <p><span >Asignación de código Qr</span></p>
        </li>
        <li>
        <p><span >Vista previa de sus datos</span></p>
        </li>
        <li>
        <p><span >Vista de las recientes participaciones </span></p>
        </li>
        <li>
        <p><span >Gestión de los archivos </span></p>
        </li>
        <li>
        <p><span >Gestión de su buzón </span></p>
        </li>
        </ul>
        </td>
        </tr>
        <tr >
        <td >
        <p><span >Planificaciones (POA)</span></p>
        </td>
        <td >
        <ul>
        <li>
        <p><span >Crear</span></p>
        </li>
        <li>
        <p><span >Actualizar </span></p>
        </li>
        <li>
        <p><span >Eliminar</span></p>
        </li>
        <li>
        <p><span >Asignación de modelos programáticos</span></p>
        </li>
        <li>
        <p><span >Asignación de Actividades, módulos , número de sesiones. </span></p>
        </li>
        <li>
        <p><span >Planificación por meses en número de actividades, número participantes (comunidades, tipo de participante, coordinador, mes) y cuentas contables (presupuesto a gastar por mes y calculo total).</span></p>
        </li>
        <li>
        <p><span >Seguimiento de Número de Actividades, número de participantes (reporte de cuantas actividades tiene cada comunidad y visualización de la imagen de quien creo la asistencia), cuentas contables (verificar si se cumplió el presupuesto o no)</span></p>
        <p>&nbsp;</p>
        </li>
        </ul>
        </td>
        </tr>
        <tr >
        <td >
        <p><span >Acta entrega recepción </span></p>
        </td>
        <td >
        <ul>
        <li>
        <p><span >Filtrado de las actividades que solo tiene la cuenta contable materiales</span></p>
        </li>
        <li>
        <p><span >Especificación del mes para crear una acta</span></p>
        </li>
        <li>
        <p><span >Reporte de la acta finalizada </span></p>
        </li>
        <li>
        <p><span >Envió de notificaciones </span></p>
        </li>
        </ul>
        </td>
        </tr>
        <tr >
        <td >
        <p><span >Crear la hoja de registro de asistencia a las actividades</span></p>
        </td>
        <td >
        <ul>
        <li>
        <p><span >Filtrado de las actividades según el mes de planificación a cada gestor.</span></p>
        </li>
        <li>
        <p><span >Crear nuevos registros </span></p>
        </li>
        <li>
        <p><span >Guardar registro de asistencia en base al código QR </span></p>
        </li>
        <li>
        <p><span >Exportación de reportes </span></p>
        </li>
        </ul>
        </td>
        </tr>
        <tr >
        <td >
        <p><span >Gestión de la carpeta digital para cada participante</span></p>
        </td>
        <td >
        <p><span >Crear, Actualizar, Eliminar archivos pdf</span></p>
        </td>
        </tr>
        <tr >
        <td >
        <p><span >Buzón de mensajes</span></p>
        </td>
        <td >
        <ul>
        <li>
        <p><span >Crear cartas (Subir boletas y pdf)</span></p>
        </li>
        <li>
        <p><span >Historial de cartas envidas</span></p>
        </li>
        <li>
        <p><span >Notificaciones Emal y whatsapp</span></p>
        </li>
        <li>
        <p><span >Vista de presentación para cada participantes</span></p>
        </li>
        <li>
        <p><span >Filtrado de cartas recibidas en base a una fecha </span></p>
        </li>
        <li>
        <p><span >Registro de las respuestas a cada carta por parte del participante (imágenes en base al formato de cada carta ) </span></p>
        </li>
        <li>
        <p><span >Ayudas al participante micrófono para que trascriba los que se expresa, formularios de como de llenar y visibilidad de la carta a responde en caso de contestación</span></p>
        </li>
        <li>
        <p><span >Reportes y exportación de cada carta contestada </span></p>
        </li>
        </ul>
        </td>
        </tr>
        </tbody>
        </table>
</div>
</div>

@endsection
@push('linksCabeza')


@endpush