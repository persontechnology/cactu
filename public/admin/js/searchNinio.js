var continuarValidar = false;

function buscarNino(a) {
    var b = $('#seachNinio').html();
    var getIp = $('#getIp').val();
    var u = $(a).data('url');
    var e = $("meta[name=csrf-token]").attr("content");
    if (!e || !getIp || !u) {
        notificar('info', 'Los datos ingresados son incorrectos');
        return false;
    }

    $('#seachNinio').html('<div id="div-loader" style="margin: 2px;"><div class="loader-inner ball-pulse text-center"><div></div><div></div><div></div></div></div>');
    $.post(u, { _token: e, getIp: getIp })
        .done(function(data) {

            if (data.ok) {

                var fila;
                var cont = 0;
                $.each(data.ok, function(i, item) {
                    cont++;
                    fila += '<tr>' +
                        '<td>' + data.ok[i].asistencia.comunidad_poa_participante.poa_participante.poa.planificacion_modelo.planificacion.nombre + '</td>' +
                        '<td class="bg-dark">' + data.ok[i].asistencia.fecha + '</td>' +
                        '<td <span class=" text-success-600 ">' + data.ok[i].asistencia.comunidad_poa_participante.poa_participante.poa.actividad.modelo_programatico.codigo + ' ' + data.ok[i].asistencia.comunidad_poa_participante.poa_participante.poa.actividad.codigo + '</span></td>' +
                        '<td>' + data.ok[i].asistencia.comunidad_poa_participante.comunidad.nombre + '</td>' +
                        '</tr>';

                })
                $('#listadoAsistencias').html(fila);

            } else {
                notificar('danger', data.mjs);
            }
        })
        .always(function() {
            tablaInicio();
            continuarVali = false;
            $("html, body").animate({
                scrollTop: $("#cardBuscar").offset().top
            }, 1050)

            $("#seachNinio").hide();
        })
        .fail(function(err) {


        });
}

function tablaInicio() {
    var n = $('#namessChil').html();
    console.log(n);
    var table = $('#table-as').DataTable({
        destroy: true,
        dom: 'Bfrtip',
        paging: true,

        buttons: [{
            extend: 'excelHtml5',
            text: '<i class="icon-download7"></i> EXCEL',
            className: 'btn btn-success  p-2',
            title: 'Asistencias de ' + n,
            exportOptions: {
                stripHtml: false
            }
        }],
        language: {
            "decimal": "",
            "emptyTable": "No existen asistencias disponibles",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
    });
}