@extends('layouts.app',['title'=>'Nueva Planificación'])
@section('breadcrumbs', Breadcrumbs::render('nuevaPlanificacion'))

@section('content')

@can('crear', cactu\Models\Planificacion::class)

    <form method="POST" action="{{ route('guardar-planificacion') }}">
        @csrf
        <div class="card">
            <div class="card-header">
                Nueva planificación		
            </div>
            <div class="card-body">     
                <div class="form-group row">
                    <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre<i class="text-danger">*</i></label>
                    <div class="col-md-6">
                        <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

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
                        <input type="date"  id="desde" name="desde" value="{{ old('desde') }}" class="form-control @error('desde') is-invalid @enderror" required >
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
                        <input type="date"  id="hasta" name="hasta" value="{{ old('hasta') }}" class="form-control @error('hasta') is-invalid @enderror" required>
                        @error('hasta')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
            </div>         
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Guardar <i class="icon-paperplane ml-2"></i></button>
            </div>
        </div>
    </form> 
@else
    <div class="alert alert-primary" role="alert">
        No puede crear nueva planificación, ya que existe una en proceso.
    </div>
@endcan


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

Prueba asignando la configuración en español en la misma instancia del datepicker

<script>

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
    formatSubmit: 'yyyy/mm/dd'
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
  
  });
});

</script>
@endprepend

@endsection