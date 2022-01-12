@extends('layouts.app',['title'=>'Nueva Planificación'])
@section('breadcrumbs', Breadcrumbs::render('editarPlanificacion',$planificacion))

@section('content')
<form method="POST" action="{{ route('actualizar-planificacion') }}">
    @csrf 
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
            Editar planificación		
            </h4>
        </div>
        <div class="card-body">     
            <input type="hidden" name="planificacion" id="planificacion" value="{{$planificacion->id}}">
            <div class="form-group row">
                <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre<i class="text-danger">*</i></label>

                <div class="col-md-6">
                    <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre',$planificacion->nombre)}}" required autocomplete="nombre" autofocus>

                    @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Fecha Desde<i class="text-danger">*</i></label>
                <div class="col-md-6">
                    <input type="text"  id="desde" name="desde" value="{{ old('desde',$planificacion->desde) }}" class="form-control @error('desde') is-invalid @enderror" required >
                    @error('desde')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Fecha Hasta<i class="text-danger">*</i></label>
                <div class="col-md-6">
                    <input type="date"  id="hasta" name="hasta" value="{{ old('hasta',$planificacion->hasta) }}" class="form-control @error('hasta') is-invalid @enderror" required>
                    @error('hasta')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>  

             
            <div class="form-group row">
                <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>

                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="estado" id="estado1" value="proceso" {{ $planificacion->estado=='proceso'?'checked':'' }}>
                        <label class="form-check-label" for="estado1">
                            En proceso
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="estado" id="estado2" value="finalizado" {{ $planificacion->estado=='finalizado'?'checked':'' }}>
                        <label class="form-check-label" for="estado2">
                            Finalizado
                        </label>
                    </div>
                    @error('estado')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


        </div>
        <div class="card-footer text-muted">
            <button type="submit" class="btn btn-primary">Actualizar <i class="icon-paperplane ml-2"></i>
            </button>
        </div>
    </div>
</form> 

@push('linksCabeza')
    <script src="http://demo.interface.club/limitless/demo/bs4/Template/global_assets/js/plugins/ui/moment/moment.min.js"></script>
    <script src="http://demo.interface.club/limitless/demo/bs4/Template/global_assets/js/plugins/pickers/daterangepicker.js"></script>
    <script src="http://demo.interface.club/limitless/demo/bs4/Template/global_assets/js/plugins/pickers/anytime.min.js"></script>
    <script src="http://demo.interface.club/limitless/demo/bs4/Template/global_assets/js/plugins/pickers/pickadate/picker.js"></script>
    <script src="http://demo.interface.club/limitless/demo/bs4/Template/global_assets/js/plugins/pickers/pickadate/picker.date.js"></script>
    <script src="http://demo.interface.club/limitless/demo/bs4/Template/global_assets/js/plugins/pickers/pickadate/picker.time.js"></script>
    <script src="http://demo.interface.club/limitless/demo/bs4/Template/global_assets/js/plugins/pickers/pickadate/legacy.js"></script>
  
<script src="http://demo.interface.club/limitless/demo/bs4/Template/global_assets/js/demo_pages/picker_date.js"></script>

@endpush

@prepend('linksPie')

<script>
    $('#menuPlanificacion').addClass('active');
</script>
<script type="text/javascript">
   

$(document).ready(function() {
  $('#desde').pickadate({
    format: 'yyyy/mm/dd',
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15,
    monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
    today: 'Hoy',
    clear: 'Limpiar',
    close:'Cerrar',
    formatSubmit: 'yyyy/mm/dd',
    now:'{{$planificacion->desde}}',
    infocus:'{{$planificacion->desde}}',
    outfocus:'{{$planificacion->desde}}',
    
  });
});

$(document).ready(function() {
  $('#hasta').pickadate({
    format: 'yyyy/mm/dd',
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15,
    monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
    today: 'Hoy',
    clear: 'Limpiar',
    close:'Cerrar',
    formatSubmit: 'yyyy/mm/dd',
    now:'{{$planificacion->hasta}}',
    infocus:'{{$planificacion->hasta}}',
    outfocus:'{{$planificacion->hasta}}',
  });
});


</script>
@endprepend

@endsection