$(document).ready(function() {
    $('#continerlist').hide();
})
var continuarVali = false;
$("#hasta").rules('add', { fechaFin: "#desde" });

function verificarInformacionCliente(argument) {
    $('#listadoParticipantes').remove();
    $('#continerlist').hide();
    var e = $("meta[name=csrf-token]").attr("content");
    var url = $(argument).data('url');
    $("#form-asistencia").validate({
        errorPlacement: function(error, element) {
            if (element.parent().hasClass('input-group')) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        rules: {
            desde: {
                required: true,
                date: true
            },
            hasta: {
                required: true,
                date: true,
                fechaFin: "#desde"
            }
        },
        messages: {
            desde: {
                required: "Seleccione una fecha Inicial",
                date: "Ingrese una fecha válida"
            },
            hasta: {
                required: "Seleccione una fecha final",
                date: "Ingrese una fecha válida"
            }
        }
    });
    var $valid = $("#form-asistencia").valid();
    if (!$valid) {
        return false;
    }
    if (continuarVali) {
        return false;
    }
    continuarVali = true;


    var getIp = $('#getIp').val();
    var fechaInicio = $('#desde').val();
    var fechaFin = $('#hasta').val();
    $("#desde").prop("disabled", true);
    $("#hasta").prop("disabled", true);
    $("#btn-preguntas").prop("disabled", true);
    htmlBoton = $("#btn-preguntas").html();
    $("#btn-preguntas").removeClass('btn-info').addClass('btn-success').html('<div id="div-loader">' +
        '<div class="loader-inner ball-pulse">' +
        '<div></div><div></div><div></div>' +
        '</div></div>');
    $.post(url, { _token: e, getIp: getIp, fechaInicio: fechaInicio, fechaFin: fechaFin })
        .done(function(data) {

            if (data.ok) {
                $('#continerlist').show();
                $('#dataTable1').append('<tbody id="listadoParticipantes"></tbody>');
                var fila;
                var cont = 0;
                $.each(data.ok, function(i, item) {
                    cont++;

                    fila += '<tr>' +
                        '<td>' + cont + '</td>' +
                        '<td>' + data.ok[i].ninio.numeroChild + '</td>' +
                        '<td>' + data.ok[i].ninio.nombres + '</td>' +
                        '<td>' + data.ok[i].asistencia.fecha + '</td>' +
                        '</tr>';

                })
                $('#listadoParticipantes').append(fila);

                var sms = "Lista de asistencias de la fecha " + fechaInicio + "-" + fechaFin;
                var sms1 = "LISTADO DE ASISTENCIAS DE LA FECHA  " + fechaInicio + " A " + fechaFin;
                notificar('success', sms);

                tablaInicio(sms1, data.plani, cont);
            } else {
                notificar('danger', data.mjs);

            }
        })
        .always(function() {
            continuarVali = false;
            $("html, body").animate({
                scrollTop: $("#contenedorSe").offset().top
            }, 1050)
            $('#continerlist').show();
            $("#desde").prop("disabled", false);
            $("#hasta").prop("disabled", false);
            $("#btn-preguntas").prop("disabled", false);
            $("#btn-preguntas").html(htmlBoton);
        })
        .fail(function(err) {
            console.log("Maestria, no Editada verifique sus valores y vuelva a intentar.", "info");

        });
}

function tablaInicio(sms, pla, cont) {
    var reportType = sms;
    var plani = pla.nombre;

    var d = new Date();
    var fecha = ("0" + d.getDate()).slice(-2) + "-" + ("0" + (d.getMonth() + 1)).slice(-2) + "-" +
        d.getFullYear() + " " + ("0" + d.getHours()).slice(-2) + ":" + ("0" + d.getMinutes()).slice(-2);

    var table = $('#dataTable1').DataTable({
        destroy: true,
        dom: 'Bfrtip',
        paging: true,

        buttons: [{
            extend: 'excelHtml5',
            text: '<i class="icon-download7"></i> EXCEL',
            className: 'btn btn-success  p-2',
            title: '',
            exportOptions: {
                stripHtml: false
            },

            customize: function(xlsx) {

                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                var downrows = 3;
                var clRow = $('row', sheet);
                $(clRow[4]).attr('width', 80)
                    //update Row

                clRow.each(function() {
                    var attr = $(this).attr('r');
                    var ind = parseInt(attr);
                    ind = ind + downrows;
                    $(this).attr("r", ind);
                });

                // Update  row > c
                $('row c ', sheet).each(function() {
                    var attr = $(this).attr('r');
                    var pre = attr.substring(0, 1);
                    var ind = parseInt(attr.substring(1, attr.length));
                    ind = ind + downrows;
                    $(this).attr("r", pre + ind);
                });

                function Addrow(index, data) {
                    msg = '<row r="' + index + '">'
                    for (i = 0; i < data.length; i++) {
                        var key = data[i].k;
                        var value = data[i].v;
                        msg += '<c t="inlineStr" r="' + key + index + '" s="42">';
                        msg += '<is>';
                        msg += '<t>' + value + '</t>';
                        msg += '</is>';
                        msg += '</c>';
                    }
                    msg += '</row>';
                    return msg;
                }

                //insert
                var r1 = Addrow(1, [{ k: 'A', v: sms }, { k: 'B', v: '' }, { k: 'C', v: '' }, { k: 'D', v: '' }]);
                var r2 = Addrow(2, [{ k: 'A', v: 'Planificación: ' }, { k: 'B', v: plani }, { k: 'C', v: 'Fecha Consulta: ' }, { k: 'D', v: fecha }]);
                var r3 = Addrow(3, [{ k: 'A', v: ' ' }, { k: 'B', v: 'TOTAL REGISTROS' }, { k: 'C', v: cont }, { k: 'D', v: '' }]);

                sheet.childNodes[0].childNodes[1].innerHTML = r1 + r2 + sheet.childNodes[0].childNodes[1].innerHTML;
            },
            fnInit: function(nButton, oConfig) {
                $(nButton).addClass('btn btn-primary  ');
                nButton.html('<div id="div-loader">' +
                    '<div class="loader-inner ball-pulse text-white">' +
                    '<div></div><div></div><div></div>' +
                    '</div></div>');
            },
            fnClick: function(nButton, oConfig, oFlash) {
                console.log('Export..');
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