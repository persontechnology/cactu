@extends('layouts.app',['title'=>'Gestores'])

@section('breadcrumbs', Breadcrumbs::render('participanteNuevoAsignacion',$usuario))



@section('content')

<form action="{{ route('asignarComunidadesParticipante') }}" method="POST">
    @csrf
    <div class="card">
        <div class="card-header">
            Comunidades de {{ $usuario->name }}
        </div>
        <div class="card-body">
            <input type="hidden" name="usuario" value="{{ $usuario->id }}" required>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">Comunidad</th>
                        <th scope="col">Asignar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comunidadesAsignadas as $com)
                            <tr>
                                <th scope="row">{{ $com->nombre }}</th>
                                <td>
                                    <input name="comunidades[{{ $com->id }}]" value="{{ $com->id }}" type="checkbox" checked   data-toggle="toggle" data-on="SI" data-off="NO" data-onstyle="success" data-offstyle="danger" data-size="xs">
                                </td>
                            </tr>
                        @endforeach

                        @foreach ($comunidadesNoAsignadas as $com_x)
                            <tr>
                                <th scope="row">{{ $com_x->nombre }}</th>
                                <td>
                                    <input name="comunidades[{{ $com_x->id }}]" value="{{ $com_x->id }}" type="checkbox"   data-toggle="toggle" data-on="SI" data-off="NO" data-onstyle="success" data-offstyle="danger" data-size="xs">
                                </td>
                            </tr>
                        @endforeach
                        
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted">
            <button class="btn btn-primary" type="submit">Guardar <i class="icon-paperplane ml-2"></i></button>
        </div>
    </div>
</form>

@push('linksCabeza')
{{--  toogle  --}}
<link href="{{ asset('admin/plus/bootstrap4-toggle/css/bootstrap4-toggle.min.css') }}" rel="stylesheet">
<script src="{{ asset('admin/plus/bootstrap4-toggle/js/bootstrap4-toggle.min.js') }}"></script>
{{--  select  --}}
<link rel="stylesheet" href="{{ asset('admin/plus/select/css/bootstrap-select.min.css') }}">
<script src="{{ asset('admin/plus/select/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('admin/plus/select/js/lg/defaults-es_ES.min.js') }}"></script>

@endpush

@prepend('linksPie')
    <script>
        $('#menuParticipantes').addClass('active');
    </script>
    
    
@endprepend

@endsection
