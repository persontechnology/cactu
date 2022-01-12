function mostrarModal() {

    $('#modal_ayuda').fadeOut(1500, function() { $('#modal_ayuda').modal('show') });

}
//configracion pra la carga del div
var configblock = {
    message: '<i style="-webkit-animation: rotation 1s linear infinite;width: 30%; top: 75%; left: auto; text-align: center; color: rgb(0, 0, 0); border: 0px;" class="icon-spinner3 spinner fa-5x "></i>',

    overlayCSS: {
        backgroundColor: '#fff',
        opacity: 0.8,
        cursor: 'wait'
    },
    css: {
        border: 0,
        padding: 0,
        backgroundColor: 'none'
    }
};

function filenoex(ca) {
    var url = '{{ route("actualizarCartaBolante") }}'

    var imex;
    if (ca.cartas_buzon.bolante != null && ca.cartas_buzon.bolante1 != null) {

        imex = 'storage/boletas/' + ca.cartas_buzon.bolante, 'storage/boletas/' + ca.cartas_buzon.bolante1

    }

    if (ca.cartas_buzon.bolante != null) {
        imex = 'storage/boletas/' + ca.cartas_buzon.bolante
    }

    if (ca.cartas_buzon.bolante1 != null) {
        imex = 'storage/boletas/' + ca.cartas_buzon.bolante1
    }


    console.log(imex)

    $(".file-inputex" + ca.cartas_buzon.id).fileinput({
        uploadUrl: url,
        theme: 'explorer-fas',

        uploadExtraData: {
            getip: ca.cartas_buzon.id,

        },

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
        initialPreview: [


        ],
        initialPreviewAsData: true,
        initialPreviewConfig: [

        ],
        previewFileIcon: '<i class="fas fa-file-pdf text-danger"></i>',

        language: 'es',

    });


    if (ca.archivo == 1) {
        $(".file-inputexar" + ca.cartas_buzon.id).fileinput({
            theme: 'explorer-fas',

            uploadAsync: true,
            resizeImage: true,
            showBrowse: false,
            browseOnZoneClick: true,
            allowedFileExtensions: ["pdf"],
            maxFileSize: 5000,
            autoReplace: true,
            maxFileCount: 2,
            actionUpload: false,
            initialPreviewAsData: true,
            showCaption: true,
            showPreview: true,
            showRemove: true,
            showUpload: true, // <------ just set this from true to false
            showCancel: false,
            layoutTemplates: { actions: '<div class="file-actions">\n' + ' <div class="file-footer-buttons">\n' + '  {delete} {zoom} {other}' + ' </div>\n' + ' {drag}\n' + ' <div class="clearfix"></div>\n' + '</div>', actionDelete: '<button type="button" class="kv-file-remove btn-primary {removeClass}" title="{removeTitle}"{dataUrl}{dataKey}>{removeIcon}</button>\n', actionUpload: '<button type="button" class="kv-file-upload {uploadClass}" title="{uploadTitle}">{uploadIcon}</button>\n', actionZoom: '<button type="button" class="kv-file-zoom {zoomClass}" title="{zoomTitle}">{zoomIcon}</button>', actionDrag: '<span class="file-drag-handle {dragClass}" title="{dragTitle}">{dragIcon}</span>' },
            language: 'es',

        }).on('fileselect', function(event, numFiles, label) {

        }).on('fileuploaded', function(e, params, previewId, index) {

        }).on('fileuploaderror', function(event, data, msg) {

        }).on('filebatchuploadcomplete', function(event, preview, config, tags, extraData) {


        });
    }




}

function cargarex(ca) {
    var d = (ca.imagenes > 1) ? "s" : " ";
    var di = (ca.imagenes > 1) ? "es de los" : " del";
    var m = (ca.imagenes > 1) ? "multiple" : "";
    var dar = (ca.archivo == 1) ? "* Recuerda que en esta carta debes subir el  pdf de la carta recibida" : " ";
    var darc = (ca.archivo == 1) ? "12" : "6";

    var fila = '<div class="card col-sm-' + darc + ' " id="scrolsi' + ca.cartas_buzon.id + '">' + '' +
        '<div class="card-header header-elements-inline pb-0 ">' + '' +
        '<h6 class="card-title text-center">Carta de: ' + ca.nombre + '</br>' + '' +



        '</h6>' + '' +
        '<div class="header-elements">' + '' +
        '<div class="list-icons">' + '' +

        '<a href="#" class="list-icons-item text-danger"><i class="fas fa-trash-alt fa-2x"></i></a>' + '' +
        '</div>' + '' +
        '</div>' + '' +
        '</div>  ' + '' +

        '<div class="card-body">' + '' +
        '<div class="row mayUno">' + '' +
        '<div class="col-sm-12">' + '' +
        '<div class="card-img-actions mx-1 mt-1 ">' + '' +
        '<label class="text-danger">* Recuerda que puedes subir asta ' + ca.imagenes + ' imágen' + di + ' bolante' + d + '</label>' + '' +
        '<div class="file-loading">' + '' +
        '<input type="file"  class="file-inputex' + ca.cartas_buzon.id + '" accept="image/*" name="imagen" ' + m + '>' + '' +

        '</div>  ' + '' +
        '</div>' + '' +
        '</div>  ' + '' +
        '</div>' + '' +
        '</div>' + '' +
        '</div>' + '' +
        '</div>'
    $('#cartasCreadas').append(fila);
    if (ca.archivo == 1) {
        $('.mayUno').empty();
        var filaAr = '<div class="col-sm-6">' + '' +
            '<div class="card-img-actions mx-1 mt-1 ">' + '' +
            '<label class="text-danger">* Recuerda que puedes subir asta ' + ca.imagenes + ' imágen' + di + ' bolante' + d + '</label>' + '' +
            '<div class="file-loading">' + '' +
            '<input type="file"  class="file-inputex' + ca.cartas_buzon.id + '" accept="image/*" name="imagen" ' + m + ' >' + '' +

            '</div>  ' + '' +
            '</div>' + '' +
            '</div>  ' + '' +
            '<div class="col-sm-6">' + '' +
            '<div class="card-img-actions mx-1 mt-1 ">' + '' +
            '<label class="text-danger">' + dar + '</label>' + '' +
            '<div class="file-loading">' + '' +
            '<input type="file"  class="file-inputexar' + ca.cartas_buzon.id + '" accept="application/pdf" name="archivo" >' + '' +

            '</div>  ' + '' +
            '</div>' + '' +
            '</div>'
        $('.mayUno').append(filaAr);

    }

}

function buscarCaatas(getIp) {
    $('#cartasCreadas').empty();

    var urlB = '{{ route("bucarCargasNuevo") }}';
    $.post(urlB, { getIp: getIp })
        .done(function(d) {

            if (d == "msj") {
                notificar("error", 'datos encontrados' + d.msj)
            } else {
                var c = 0;
                $.each(d.cartasHoy, function(i, item) {
                    console.log(d.cartasHoy[i])
                    cargarex(d.cartasHoy[i]);
                    filenoex(d.cartasHoy[i])
                })



            }
        }).always(function() {


        }).fail(function(error) {
            notificar("error", "Ocurrio un error no puede mostrar los datos seleccionados datos incorrectos");
        });
}

function gestionarCartas(c) {

    var getIp = $(c).data('getip');
    var getTi = $(c).data('getti');
    var url = $(c).data('urlbc');
    $.post(url, { getIp: getIp, getTi: getTi })
        .done(function(d) {

            if (d == "msj") {
                notificar("error", 'datos encontrados' + d.msj)
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