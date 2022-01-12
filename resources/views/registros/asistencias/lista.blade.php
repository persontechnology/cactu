@extends('layouts.app',['title'=>'Listado de poas'])

@section('breadcrumbs', Breadcrumbs::render('asistencias',$comuPoaParticipante))


@section('content')

@can('puedeCrearAsistencia', $comuPoaParticipante)
<form action="{{ route('crearAsistencia') }}" method="POST">
    <div class="card">
        @csrf
        <input type="hidden" name="comupoaparti" value="{{ $comuPoaParticipante->id }}" required>
        @include('registros.asistencias.tabla',['comuPoaPart'=>$comuPoaParticipante]) 
        
        <div class="card-footer">
            <button class="btn btn-primary btn-lg" type="submit">Crear registro de asistencia a actividades</button>
        </div>
    </div>
    
</form>
@endcan

@if(count($comuPoaParticipante->asistencias)>0)

    @foreach ($comuPoaParticipante->asistencias as $asis)
    <div class="card">

        
        <div id="cargaListado_{{ $asis->id }}">

        </div>
        <script>
                cargaListado("{{ $asis->id }}","{{ route('cargaListado',$asis->id) }}");
        </script>
        
        

        <div class="card-footer">

            @can('puedoTomarAsistencia', $asis)

                <a href="{{ route('registrarAsistencia',$asis->id) }}" class="btn btn-primary">
                    <i class="fas fa-user-check"></i> Registrar asistencia
                </a>

            @endcan
        </div>
    </div>

    
    @endforeach
                    
@endif

@push('linksCabeza')

<script>
        function cargaListado(div,url){
            console.log(url)
            $("#cargaListado_"+div ).load(url,function( response, status, xhr ){
                if ( status == "error" ) {
                    notificar('warning','No se pudo cargar el listado')
                }
            }); 
        }
</script>

@endpush

@prepend('linksPie')
    <script>
        $('#menuRegistroAsistencia').addClass('active');

        

        //esta  funcion esta tambien es registrar
        function actualizar(arg){
            var cuentaContable=$(arg).val();
            var lista=$(arg).data('lista');
            var div=$(arg).data('asis');
            var url=$(arg).data('url');

            $.blockUI({message:'<h1>Espere por favor.!</h1>'});
            $.post("{{ route('actualiuzarCuentasContablesLista') }}", { cuentaContable:cuentaContable,lista:lista})
            .done(function( data ) {
                if(data.success){
                    notificar('success',data.success);
                }
                if(data.info){
                    notificar('info',data.info);
                }
                if(data.default){
                    notificar('default',data.default);
                }
                cargaListado(div,url);
            }).always(function(){
                $.unblockUI();
            }).fail(function(){
                notificar("error","Ocurrio un error");
            });
        }


        //esta funcion esta tambien en registrar
        function opcion(arg){
            $.blockUI({message:'<h1>Espere por favor.!</h1>'});
            var lista=$(arg).val();
            var opcion=$(arg).data('opcion');
            var estado="no";
            if($(arg).is(':checked')){
                estado="si";
            }
            var div=$(arg).data('div');
            var url=$(arg).data('url');

            $.post("{{ route('actualizarOpcionLista') }}", { lista:lista,opcion:opcion,estado:estado})
            .done(function( data ) {
                if(data.success){
                    notificar('success',data.success);
                }
                if(data.info){
                    notificar('info',data.info);
                }
                if(data.default){
                    notificar('default',data.default);
                }
                cargaListado(div,url);
            }).always(function(){
                $.unblockUI();
            }).fail(function(){
                notificar("error","Ocurrio un error");
            });
        }



        //este esta en registar tambie
        function detalle(arg){
            var asis=$(arg).data('asis');
            var detalle=$(arg).val();
            $.post("{{ route('actualizarDetalleAsistencia') }}", { asis:asis,detalle:detalle})
            .done(function( data ) {
                if(data.success){
                    $('#msg_detalle_'+asis).addClass('text-success');
                    $('#msg_detalle_'+asis).html('Guardado exitosamente');
                }
                if(data.default){
                    $('#msg_detalle_'+asis).addClass('text-danger');
                    $('#msg_detalle_'+asis).html(data.default);
                }
                
            }).always(function(){
                
            }).fail(function(){
                $('#msg_detalle_'+asis).addClass('text-danger');
                $('#msg_detalle_'+asis).html('Ocurrio un error');
            });
        }
    </script>
    
@endprepend

@endsection
