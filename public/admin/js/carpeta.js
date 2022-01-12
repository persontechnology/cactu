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
   //vaciar componetes 
   function vaciarCOmponetes() {
       $('#archivosPdf').empty();
       $('#archivosPdfNo').empty();
       $('#porcentaje').empty();
       $('#sortable-list-basic').empty();
       $('#filecarga').empty();
       $('#toNoIngre').empty();
   }
   //inicial ex
   function cargarex(d, c) {

       var fila = '<div class="col-sm-4 " id="scrolsi' + c + '">' + '' +
           '<div class="card file-preview-frame explorer-frame  ">' + '' +
           '<div class="card-img-actions mx-1 mt-1 ">' + '' +
           '<div class="file-loading">' + '' +
           '<input type="file"  class="file-inputex' + c + '" accept="application/pdf" name="archivo" >' + '' +

           '</div>  ' + '' +
           '</div>' + '' +
           '<div class="card-body">' + '' +
           '<div class="d-flex align-items-start flex-nowrap">' + '' +
           '<div>' + '' +

           '<span class="text-primary">Creado: ' + d.created_at + '<br>Actualizado:' + d.updated_at + ' </span>' + '' +

           '</div>' + '' +

           '</div>' + '' +
           '</div>' + '' +
           '</div>' + '' +
           '</div>'
       $('#archivosPdf').append(fila);

   }

   //inicial noex
   function cargarnoex() {
       var fila = '<label class="text-danger"> * La Extensión del archivo debe ser pdf y el peso máximo del archivo debe ser de 4MB </label>' + '' +

           '<div class="file-loading">' + '' +
           '<input id="kv-explorer" type="file" accept="application/pdf" name="archivo" multiple>' + '' +
           '</div> '
       $('#filecarga').append(fila);
   }

   //file ex
   function fileex(d, getIp, c, u, ulc, urla, urle) {

       var de = "<strong>" + d.archivo + "</strong>";
       $(".file-inputex" + c).fileinput({
           uploadUrl: urla,
           theme: 'explorer-fas',

           uploadExtraData: {
               getip: getIp,
               getid: d.tipo_archivo.id,
               getipac: d.id,
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
           initialPreview: ['storage/carpeta/' + d.archivo],
           initialPreviewAsData: true,
           initialPreviewConfig: [
               { type: 'pdf', caption: d.tipo_archivo.nombre, url: urle, key: d.id },
           ],
           previewFileIcon: '<i class="fas fa-file-pdf text-danger"></i>',
           preferIconicPreview: true, // this will force thumbnails to display icons for following file extensions
           previewFileIconSettings: { // configure your icon file extensions

               'pdf': '<i class="fas fa-file-pdf text-danger"></i>',

           },
           language: 'es',
           initialCaption: d.archivo,
       }).on('filesorted', function(e, params) {
           $('#kv-success-box').html('');
       }).on('fileuploaded', function(e, params) {
           var url = params.response.link;
           $('#kv-success-box').append(url);
           notificar('info', 'Archivo actualizado');

       }).on('filebeforedelete', function() {

           return new Promise(function(resolve, reject) {
               $.confirm({
                   title: '¡Confirmación!',
                   content: 'Esta segur@ que desea eliminar el archivo de ? ' + d.archivo,
                   type: 'red',
                   buttons: {
                       ok: {
                           text: "Aceptar",
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
                   },

               });
           });

       }).on('filedeleted', function(e, params) {
           $('#collapsible-si' + c).collapse('hide');
           $("#scrolsi" + c).fadeOut(1000);
           $("#toNoIngre").html('');
           noexiste(getIp, u, ulc, urla, urle);
           $('#dataTableBuilder').DataTable().draw(true);
       });
   }

   function filenoex(getIp, cn, u, urlc, urla, urle) {
       $('#mostrarMayor').show();
       var getip = "";
       var getid = "";
       var ct = 0;

       $("#kv-explorer").fileinput({
           theme: 'explorer-fas',
           uploadUrl: urlc,
           uploadAsync: true,
           resizeImage: true,
           showBrowse: false,
           browseOnZoneClick: true,
           allowedFileExtensions: ["pdf"],
           maxFileSize: 5000,
           autoReplace: true,
           maxFileCount: cn,
           actionUpload: false,
           initialPreviewAsData: true,
           showCaption: true,
           showPreview: true,
           showRemove: true,
           showUpload: true, // <------ just set this from true to false
           showCancel: false,
           layoutTemplates: { actions: '<div class="file-actions">\n' + ' <div class="file-footer-buttons">\n' + '  {delete} {zoom} {other}' + ' </div>\n' + ' {drag}\n' + ' <div class="clearfix"></div>\n' + '</div>', actionDelete: '<button type="button" class="kv-file-remove btn-primary {removeClass}" title="{removeTitle}"{dataUrl}{dataKey}>{removeIcon}</button>\n', actionUpload: '<button type="button" class="kv-file-upload {uploadClass}" title="{uploadTitle}">{uploadIcon}</button>\n', actionZoom: '<button type="button" class="kv-file-zoom {zoomClass}" title="{zoomTitle}">{zoomIcon}</button>', actionDrag: '<span class="file-drag-handle {dragClass}" title="{dragTitle}">{dragIcon}</span>' },
           language: 'es',
           uploadExtraData: function() {
               return getid;
           },
       }).on('fileselect', function(event, numFiles, label) {
           var caux = 0;
           var out = '';
           caux = $('#toNoIngre').text();
       }).on('fileuploaded', function(e, params, previewId, index) {
           $('#' + params.response.success).fadeOut(1500, function() { $('#' + params.response.success).remove() });

       }).on('fileuploaderror', function(event, data, msg) {
           notificar('error', 'El archivo no puede ser guardado verifique los datos de ingreso');
       }).on('filebatchuploadcomplete', function(event, preview, config, tags, extraData) {

           siexiste(getIp, u, urlc, urla, urle);

           $('#kv-explorer').fileinput('clear');
           $('#dataTableBuilder').DataTable().draw(true);

           ct = 0;
           notificar('info', 'Archivo registrado');
       });


       $("#kv-explorer").on('filepreajax', function(event, previewId, index) {
           $("#sortable-list-basic").disableSelection();
           $('#sortable-list-basic li').each(function(indice, elemento) {

               if (ct == indice) {
                   getid = { "getid": this.id, "getip": getIp };

               }
           });
           ct++;
       });

   }

   function archivos(arg) {
       $('#administracionArcivos').modal('show');

       //vaciar componetes 
       vaciarCOmponetes();

       //cargar gif            
       var light = $('.modal-content').closest('.contenedor');
       $(light).block(configblock);

       var getIp = $(arg).data('getip');

       var url = $(arg).data('url');
       var urla = $(arg).data('urla');
       var urlc = $(arg).data('urlc');
       var urle = $(arg).data('urle');
       $.post(url, { getIp: getIp })
           .done(function(d) {

               if (d == "msj") {
                   alert('datos encontrados' + d.msj)
               } else {
                   $('#administracionArcivos').modal({ backdrop: 'static', keyboard: false })
                   $('#modalnombres').html('<strong>Carpeta digital de:</strong> ' + d.ok.nombres + '<strong> Comunidad: </strong>' + d.ok.comunidad.nombre);

                   var c = 0;
                   $.each(d.ex, function(i, item) {
                       c++;
                       cargarex(d.ex[i], c);
                       fileex(d.ex[i], getIp, c, url, urlc, urla, urle);

                   })
                   var porcentaje = (c * 100) / d.num;
                   $('#porcentaje').append(
                       '<div class="progress-bar bg-primary" role="progressbar" style="width: ' + porcentaje + '%;" aria-valuenow="' + porcentaje + '" aria-valuemin="0" aria-valuemax="100""><strong>' +
                       porcentaje + '% Completo </strong>' +
                       '</div>'
                   )
                   var cn = 0;
                   $.each(d.noex, function(i, item) {
                       cn++;

                       var nn = ' <li class="p-3   mt-1 rounded cursor-move ui-sortable-handle" id="' + d.noex[i].id + '"><i class="fas fa-arrows-alt-v mr-2"></i>' + d.noex[i].nombre + '</li>'

                       $('#sortable-list-basic').append(nn);
                   })

                   /*Nueva logica*/
                   if (cn > 0) {
                       cargarnoex();
                       filenoex(getIp, cn, url, urlc, urla, urle);

                   } else {
                       $('#mostrarMayor').hide();
                   }

               }
           }).always(function() {
               $(light).unblock();

           }).fail(function(error) {
               notificar("error", "Ocurrio un error no puede mostrar los datos seleccionados datos incorrectos");
           });
   }
   $('#menuNinios').addClass('active');
   //funcion cuando existe
   function siexiste(getIp, url, urlc, urla, urle) {
       $('#archivosPdf').empty();
       $('#porcentaje').empty();


       var light = $('.modal-content').closest('#archivosPdf');
       $(light).block(configblock);
       $.post(url, { getIp: getIp })
           .done(function(d) {
               if (d == "msj") {
                   alert('datos encontrados' + d.msj)
               } else {
                   var c = 0;
                   $.each(d.ex, function(i, item) {
                       c++;
                       cargarex(d.ex[i], c);
                       fileex(d.ex[i], getIp, c, url, urlc, urla, urle)

                   })
                   var porcentaje = (c * 100) / d.num;
                   $('#porcentaje').append(
                       '<div class="progress-bar bg-primary" role="progressbar" style="width: ' + porcentaje + '%;" aria-valuenow="' + porcentaje + '" aria-valuemin="0" aria-valuemax="100""><strong>' +
                       porcentaje + '% Completo </strong>' +
                       '</div>'
                   )
                   var catT = c + 1;
                   var cn = d.num - c;

                   if (c == d.num) {
                       $('#mostrarMayor').hide();

                   } else {
                       $("#toNoIngre").html(cn);
                   }
               }
           }).always(function() {
               $(light).unblock();
           }).fail(function() {
               notificar("error", "Ocurrio un error");
           });

   }

   function noexiste(getIp, u, urlc, urla, urle) {
       $('#archivosPdfNo').empty();
       $('#porcentaje').empty();
       $('#sortable-list-basic').empty();
       $('#filecarga').empty();
       var light = $('.modal-content').closest('#archivosPdf');
       $(light).block(configblock);
       $.post(u, { getIp: getIp })
           .done(function(d) {
               if (d == "msj") {
                   alert('datos encontrados' + d.msj)
               } else {

                   var cn = 0;
                   $.each(d.noex, function(i, item) {
                       cn++;
                       var nnd = ' <li class="p-3   mt-1 rounded cursor-move ui-sortable-handle" id="' + d.noex[i].id + '"><i class="fas fa-arrows-alt-v mr-2"></i>' + d.noex[i].nombre + '</li>'

                       $('#sortable-list-basic').append(nnd);
                   })

                   /*Nueva logica*/
                   if (cn > 0) {
                       cargarnoex();
                       filenoex(getIp, cn, u, urlc, urla, urle);
                       $("#toNoIngre").html(cn);
                   } else {
                       $('#mostrarMayor').hide();
                   }

                   var ct = d.num - cn;
                   var porcentaje = (ct * 100) / d.num;
                   $('#porcentaje').append(
                       '<div class="progress-bar bg-primary" role="progressbar" style="width: ' + porcentaje + '%;" aria-valuenow="' + porcentaje + '" aria-valuemin="0" aria-valuemax="100""><strong>' +
                       porcentaje + '% Completo </strong>' +
                       '</div>'
                   )
               }
           }).always(function() {
               $(light).unblock();
           }).fail(function() {
               notificar("error", "Ocurrio un error");
           });

   }