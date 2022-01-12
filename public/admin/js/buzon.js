function mostrarModal() {
    $('#modal_ayuda').fadeOut(1500, function() { $('#modal_ayuda').modal('show') });
}
//configracion pra la carga del div
var urls = '/storage/boletas/';
var urlsa = '/storage/cartas/';

function filenoex(ca) {
    var url = '/actualizar-cartas-boleta'

    $(".file-inputex" + ca.cartas_buzon.id).fileinput({
        uploadUrl: url,
        theme: 'explorer-fas',
        uploadExtraData: {
            getip: ca.cartas_buzon.id,
        },
        allowedFileExtensions: ["jpeg", "jpg", "png"],
        maxFileSize: 5000,
        maxImageWidth: 500,
        uploadAsync: true,
        resizeImage: true,
        showBrowse: false,
        browseOnZoneClick: true,
        autoReplace: true,
        actionUpload: false,
        initialPreviewAsData: true,
        showCaption: true,
        showPreview: true,
        showRemove: false,
        showUpload: true, // <------ just set this from true to false
        showCancel: false,
        uploadLabel: "Crear",
        layoutTemplates: { actions: '<div class="file-actions">\n' + ' <div class="file-footer-buttons">\n' + '  {delete} {zoom} {other}' + ' </div>\n' + ' {drag}\n' + ' <div class="clearfix"></div>\n' + '</div>', actionDelete: '<button type="button" class="kv-file-remove btn-primary {removeClass}" title="{removeTitle}"{dataUrl}{dataKey}>{removeIcon}</button>\n', actionUpload: '<button type="button" class="kv-file-upload {uploadClass}" title="{uploadTitle}">{uploadIcon}</button>\n', actionZoom: '<button type="button" class="kv-file-zoom {zoomClass}" title="{zoomTitle}">{zoomIcon}</button>', actionDrag: '<span class="file-drag-handle {dragClass}" title="{dragTitle}">{dragIcon}</span>' },

        minFileCount: 1,
        initialPreviewAsData: true,
        language: 'es',

    }).on('fileuploaderror', function(event, data, msg) {
        notificar('error', 'La imágen no puede ser guardado verifique los datos de ingreso g');
    }).on('fileuploaderror', function(event, data, msg) {
        notificar('error', 'El archivo no puede ser guardado verifique los datos de ingreso');
    }).on('filebatchuploadcomplete', function(event, preview, config, tags, extraData) {

        $(".file-inputex" + ca.cartas_buzon.id).fileinput('clear');
        notificar('info', 'Archivo registrado');
        $('#botasImg_' + ca.cartas_buzon.id).empty();
        buscarBoleta(ca.cartas_buzon.id)
    });
    if (ca.archivo == 1) {
        var ua = '/actualizar-cartas-archivo'
        var vpdf;
        var vpdfc;
        if (ca.cartas_buzon.archivo) {
            vpdf = urlsa + ca.cartas_buzon.archivo;
            vpdfc = { type: 'pdf', caption: ca.nombre + ' ' + 'Carta', url: '/eliminar-cartas-pdf', key: ca.cartas_buzon.id };
        }

        $(".file-inputexar" + ca.cartas_buzon.id).fileinput({
            uploadUrl: ua,
            theme: 'explorer-fas',
            uploadExtraData: {
                getip: ca.cartas_buzon.id,
            },
            allowedFileExtensions: ["pdf"],
            maxFileSize: 5000,
            uploadAsync: true,
            resizeImage: true,
            showBrowse: false,
            browseOnZoneClick: true,
            autoReplace: true,
            actionUpload: false,
            initialPreviewAsData: true,
            showCaption: true,
            showPreview: true,
            showRemove: false,
            showUpload: true, // <------ just set this from true to false
            showCancel: false,
            uploadLabel: "Actualizar",
            layoutTemplates: { actions: '<div class="file-actions">\n' + ' <div class="file-footer-buttons">\n' + '  {delete} {zoom} {other}' + ' </div>\n' + ' {drag}\n' + ' <div class="clearfix"></div>\n' + '</div>', actionDelete: '<button type="button" class="kv-file-remove btn-primary {removeClass}" title="{removeTitle}"{dataUrl}{dataKey}>{removeIcon}</button>\n', actionUpload: '<button type="button" class="kv-file-upload {uploadClass}" title="{uploadTitle}">{uploadIcon}</button>\n', actionZoom: '<button type="button" class="kv-file-zoom {zoomClass}" title="{zoomTitle}">{zoomIcon}</button>', actionDrag: '<span class="file-drag-handle {dragClass}" title="{dragTitle}">{dragIcon}</span>' },
            minFileCount: 1,
            maxFileCount: 1,
            initialPreview: [vpdf, ],
            initialPreviewAsData: true,
            initialPreviewConfig: [
                vpdfc
            ],
            previewFileIcon: '<i class="fas fa-file-pdf text-danger"></i>',
            preferIconicPreview: true, // this will force thumbnails to display icons for following file extensions                
            language: 'es',
            initialCaption: ca.nombre + ' ' + 'Carta pdf',

        }).on('fileuploaded', function(e, params) {
            if (params != undefined) {
                notificar('info', 'Archivo actualizado');
            }


        }).on('filebeforedelete', function() {
            return new Promise(function(resolve, reject) {
                $.confirm({
                    title: '¡Confirmación!',
                    content: '¿Esta segur@ que desea eliminar el archivo de ? ' + ca.nombre + ' ' + 'Carta pdf',
                    type: 'red',
                    buttons: {
                        ok: {
                            btnClass: 'btn-primary text-white',
                            keys: ['enter'],
                            action: function() {
                                resolve();
                            }
                        },
                        cancel: {
                            text: "Cancelar",
                            btnClass: 'btn-danger text-white',
                        }
                    }
                });
            });
        });
    };

}

function cargarex(ca) {
    var d = (ca.imagenes > 1) ? "s" : " ";
    var di = (ca.imagenes > 1) ? "es de los" : " del";
    var m = "multiple";
    var dar = (ca.archivo == 1) ? "* Recuerda que en esta carta debes subir el  pdf de la carta recibida" : " ";
    var darc = (ca.archivo == 1) ? "12" : "6";

    var fila = '<div class="card col-sm-' + darc + ' " id="scrolsi' + ca.cartas_buzon.id + '">' + '' +
        '<div class="card-header header-elements-inline pb-0 ">' + '' +
        '<h6 class="card-title text-center">Carta de: ' + ca.nombre + '</br>' + '' +
        '</h6>' + '' +
        '<div class="header-elements">' + '' +
        '<div class="list-icons">' + '' +
        '<button onclick="eliminarCarta(this)"  class="btnEliminar btn bg-transparent border-danger text-danger rounded-round border-2 btn-icon list-icons-item text-danger list-icons-item timeline-content btn-ladda btn-ladda-progress ladda-button" data-getbt="' + ca.cartas_buzon.id + '" ><i class="fas fa-trash-alt fa-2x"></i>' + '' +
        ' <div class="ladda-progress" style="width: 140px;"></div>' + '' +
        '</button>' + '' +
        '</div>' + '' +
        '</div>' + '' +
        '</div>  ' + '' +
        '<div class="card-body">' + '' +
        '<div class="row mayUno' + ca.cartas_buzon.id + '">' + '' +
        '<div class="col-sm-12">' + '' +
        '<div class="card-img-actions mx-1 mt-1 " id="fileIngreso' + ca.cartas_buzon.id + '">' + '' +
        '<label class="text-danger">*Recuerda que debes subir por lo menos una boleta </label>' + '' +
        '<div class="file-loading">' + '' +
        '<input type="file"  class="file-inputex' + ca.cartas_buzon.id + '" accept="image/*" name="imagen" ' + m + '>' + '' +
        '</div>  ' + '' +
        '<div class="file-boletas"></div>  ' + '' +
        '</div>' + '' +
        '</div>  ' + '' +
        '</div>' + '' +
        '<div class="card-group-control card-group-control-left mt-2" id="accordion-control">' + '' +
        '<div class="card">' + '' +
        '<div class="card-header header-elements-inline bg-dark">' + '' +
        '<h6 class="card-title text-white" >' + '' +
        '<a data-toggle="collapse" class="text-white" href="#accordion-control-group_' + ca.cartas_buzon.id + ca.id + '">Boletas de la carta: ' + ca.nombre + '</a>' + '' +

        '</h6>' + '' +

        '</div>' + '' +
        '<div class="card-body collapse show" id="accordion-control-group_' + ca.cartas_buzon.id + ca.id + '"  data-parent="#accordion-control">' + '' +
        '<div class="row" id="botasImg_' + ca.cartas_buzon.id + '">' + '' +
        '</div>' + '' +
        '</div>' + '' +
        '</div>' + '' +
        '</div>' + '' +
        '</div>' + '' +

        '</div>' + '' +
        '</div>' + '' +
        '</div>'
    $('#cartasCreadas').append(fila);
    if (ca.archivo == 1) {
        $('.mayUno' + ca.cartas_buzon.id).empty();

        var filaAr = '<div class="col-sm-6">' + '' +
            '<div class="card-img-actions mx-1 mt-1 ">' + '' +
            '<label class="text-danger">*Recuerda que debes subir por lo menos una boleta</label>' + '' +
            '<div class="file-loading">' + '' +
            '<input type="file"  class="file-inputex' + ca.cartas_buzon.id + '" accept="image/*" name="imagen" ' + m + ' >' + '' +

            '</div>  ' + '' +
            '</div>' + '' +
            '</div>  ' + '' +
            '<div class="col-sm-6">' + '' +
            '<div class="card-img-actions mx-1 mt-1 " >' + '' +
            '<label class="text-danger">' + dar + '</label>' + '' +
            '<div class="file-loading">' + '' +
            '<input type="file"  class="file-inputexar' + ca.cartas_buzon.id + '" accept="application/pdf" name="archivo" >' + '' +

            '</div>  ' + '' +
            '</div>' + '' +
            '</div>'
        $('.mayUno' + ca.cartas_buzon.id).append(filaAr);

    }

}

function buscarBoleta(getIp) {
    var urlB = '/buscar-cartas-boleta';
    $.post(urlB, { getIp: getIp })
        .done(function(d) {
            if (d.msj) {
                notificar("error", 'datos encontrados' + d.msj)
            } else {

                $.each(d.ok, function(i, item) {

                    var img = '<div class="col-sm-6 col-lg-4">' + '' +
                        '<div class="card3">' + '' +
                        '<div class="card-img-actions m-1 text-center">' + '' +
                        '<img class=""  width="82" height="82"  src="' + urls + d.ok[i].boleta + '" alt="">' + '' +
                        '<div class="card-img-actions-overlay card-img">' + '' +
                        '<a href="' + urls + d.ok[i].boleta + '" data-fancybox data-width="348" data-height="265" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2" >' + '' +
                        '<i class="icon-plus3"></i>' + '' +
                        '</a>' + '' +
                        '<a onclick="borrarBoleta(this);" data-key="' + d.ok[i].id + '" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2">' + '' +
                        '<i class="fas fa-trash-alt "></i>' + '' +
                        '</a>' + '' +
                        '</div>   ' + '' +
                        '</div>' + '' +
                        '</div>' + '' +
                        '</div>'
                    $('#botasImg_' + d.ok[i].buzon_cartas_id).append(img)
                });
            }
        }).always(function() {

        }).fail(function(error) {
            notificar("error", "Ocurrio un error no puede mostrar los datos seleccionados datos incorrectos");
        });
}

function buscarCaatas(getIp) {
    $('#cartasCreadas').empty();
    var urlB = '/buscar-cartas-nuevo';
    $.post(urlB, { getIp: getIp })
        .done(function(d) {
            if (d.msj) {
                notificar("error", 'datos encontrados' + d.msj)
            } else {

                $('#butonEnviar').empty();
                $('#estadoCartas').html('Estado: ' + d.buzon);
                var btn = '<button onclick="enviarCartas(this)" data-getip="' + d.idBuzon + '" class="btn btn-primary btn-lg btn-block list-icons-item timeline-content btn-ladda btn-ladda-progress ladda-button">' + '' +
                    '<i class="icon-check"></i> Enviar' + '' +
                    ' <div class="ladda-progress" style="width: 140px;"></div>' + '' +
                    ' </button>';
                $.each(d.cartasHoy, function(i, item) {
                    cargarex(d.cartasHoy[i]);
                    filenoex(d.cartasHoy[i]);
                    buscarBoleta(d.cartasHoy[i].cartas_buzon.id)

                })
                if (d.buzon == 'Creada') {
                    $('#butonEnviar').append(btn);

                }
            }
        }).always(function() {

        }).fail(function(error) {
            notificar("error", "Ocurrio un error no puede mostrar los datos seleccionados datos incorrectos");
        });
}

function gestionarCartas(c) {

    var getIp = $(c).data('getip');
    var getTi = $(c).data('getti');
    var url = '/crear-cartas-nuevo';
    $.post(url, { getIp: getIp, getTi: getTi })
        .done(function(d) {

            if (d.msj) {
                notificar("error", 'Datos encontrados ' + d.msj)
            } else {

                $('#tipo_' + $(c).data('getca')).fadeOut(1500, function() { $('#tipo_' + $(c).data('getca')).remove() });
                notificar("success", "carta creada");

            }
        }).always(function() {
            buscarCaatas(getIp);

        }).fail(function(error) {
            notificar("error", "Ocurrio un error no puede mostrar los datos seleccionados datos incorrectos");
        });

}

function enviarCartas(e) {
    var geti = $(e).data('getip');

    $.confirm({
        title: '¡Confirmación!',
        content: '¿Esta segur@ que desea enviar las cartas ?',

        type: 'red',
        buttons: {
            ok: {
                btnClass: 'btn-primary text-white',
                text: 'Enviar',
                keys: ['enter'],
                action: function() {
                    $.blockUI({ message: '<h1>Espere por favor enviando notificaciones.!</h1>' });
                    $.post('/enviar-cartas-pdf', { geti: geti })
                        .done(function(d) {
                            if (d.error) {
                                notificar("error", d.error)
                            } else {
                                console.log(d.esb);
                                notificar("success", "carta enviada exitosamente");
                                $('.btnEliminar').fadeOut(1500, function() { $('.btnEliminar').parent().remove() });
                                $('#butonEnviar').fadeOut(1500, function() { $('#butonEnviar').empty() });
                                document.getElementById("estadoCartas").innerHTML = 'Estado: Enviada';

                            }
                        }).always(function() {
                            $.unblockUI();
                        }).fail(function(error) {
                            notificar("error", "Ocurrio un error no puede no puede enviar la carta" + error);
                        });
                }
            },
            cancel: {
                text: "Cancelar",
                btnClass: 'btn-danger text-white',
            }
        }
    });

}

function eliminarCarta(bt) {

    var getibt = $(bt).data('getbt');

    $.confirm({
        title: '¡Confirmación!',
        content: '¿Esta segur@ que desea elimar la carta ?',

        type: 'red',
        buttons: {
            ok: {
                btnClass: 'btn-primary text-white',
                text: 'Eliminar',
                keys: ['enter'],
                action: function() {
                    $.post('/eliminar-cartas-total', { geti: getibt })
                        .done(function(d) {
                            if (d.error) {
                                notificar("error", d.error)
                            } else {

                                var addta = '<th id="tipo_' + d.ti + '">' + '' +
                                    '<button class="btn btn-primary list-icons-item timeline-content btn-ladda btn-ladda-progress ladda-button" data-getca="' + d.ti + '"  onclick="gestionarCartas(this)" data-getip="' + d.enn + '" data-getti="' + d.tica + '" >' + '' +
                                    '<i class="icon-plus3"></i> Crear ' + d.tino +
                                    '<div class="ladda-progress" style="width: 140px;"></div>' + '' +
                                    '</button>' + '' +
                                    '</th>';

                                $('#tablaTipo>thead>tr').append(addta);
                                notificar("success", "carta eliminada exitosamente");
                                $("#scrolsi" + getibt).fadeOut(1000);
                                if (d.bt == "si") {
                                    $('#butonEnviar').empty();
                                    $('#estadoCartas').empty();
                                }

                            }
                        }).always(function() {

                        }).fail(function(error) {
                            notificar("error", "Ocurrio un error no puede no puede enviar la carta" + error);
                        });
                }
            },
            cancel: {
                text: "Cancelar",
                btnClass: 'btn-danger text-white',
            }
        }
    });
}

function borrarBoleta(bt) {

    var getibt = $(bt).data('key');

    $.confirm({
        title: '¡Confirmación!',
        content: '¿Esta segur@ que desea elimar la boleta ?',

        type: 'red',
        buttons: {
            ok: {
                btnClass: 'btn-primary text-white',
                text: 'Eliminar',
                keys: ['enter'],
                action: function() {
                    $.post('/eliminar-cartas-boleta', { key: getibt })
                        .done(function(d) {
                            if (d.error) {
                                notificar("error", d.error)
                            } else {

                                $('#botasImg_' + d.ok).empty();
                                buscarBoleta(d.ok);
                                notificar("succes", "Boleta elimna exitosamente")
                            }
                        }).always(function() {

                        }).fail(function(error) {
                            notificar("error", "Ocurrio un error no puede no puede enviar la carta" + error);
                        });
                }
            },
            cancel: {
                text: "Cancelar",
                btnClass: 'btn-danger text-white',
            }
        }
    });
}