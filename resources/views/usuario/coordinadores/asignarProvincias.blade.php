@extends('layouts.app',['title'=>'Asignar provincia'])
@section('breadcrumbs', Breadcrumbs::render('coordinadoresAsignarProvincia',$usuario))
@section('content')
<form method="POST" action="{{ route('coordinadorActualizarAsignacionProvincia') }}">
    @csrf
    <input type="hidden" name="usuario" value="{{ $usuario->id }}" required>
    <div class="card">
        <div class="card-header">
            Asignación de provincia para {{ $usuario->name }}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="bg-dark">
                        <tr>
                        <th scope="col">Provincia</th>
                        <th scope="col">Asignar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($provinciasAsignadas as $proAsig)
                            <tr>
                                <th scope="row">{{ $proAsig->nombre }}</th>
                                <td>
                                    <input name="provincias[{{ $proAsig->id }}]" {{ (collect(old('provincias'))->contains($proAsig->id)) ? 'checked':'' }} checked value="{{ $proAsig->id }}" type="checkbox"   data-toggle="toggle" data-on="SI" data-off="NO" data-onstyle="success" data-offstyle="danger" data-size="xs">
                                </td>
                            </tr>
                        @endforeach

                        @foreach ($provinciasNoAsignadas as $proNoAsig)
                            <tr>
                                <th scope="row">{{ $proNoAsig->nombre }}</th>
                                <td>
                                    <input name="provincias[{{ $proNoAsig->id }}]" {{ (collect(old('provincias'))->contains($proNoAsig->id)) ? 'checked':'' }} value="{{ $proNoAsig->id }}" type="checkbox"   data-toggle="toggle" data-on="SI" data-off="NO" data-onstyle="success" data-offstyle="danger" data-size="xs">
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted">
                <button type="submit" class="btn btn-primary">
                    {{ __('Actualizar asignaciones') }} <i class="icon-paperplane ml-2"></i>
                </button>
        </div>
    </div>
</form>


@push('linksCabeza')
    <link href="{{ asset('admin/plus/bootstrap4-toggle/css/bootstrap4-toggle.min.css') }}" rel="stylesheet">
    <script src="{{ asset('admin/plus/bootstrap4-toggle/js/bootstrap4-toggle.min.js') }}"></script>
@endpush

@prepend('linksPie')
    <script>
        $('#menuCoordinadores').addClass('active');
    </script>
    
@endprepend

@endsection
