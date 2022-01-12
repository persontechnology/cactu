@extends('layouts.app',['title'=>'Descargar códigos QRS'])

@section('breadcrumbs', Breadcrumbs::render('qrsNinioPdfDescargar'))

@section('barraLateral')

@endsection

@section('content')

<div class="card">
    <div class="card-header">
        Listado de comunidades
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Comunidad</th>
                    <th scope="col">Total de niños</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php($i=0)
                @foreach ($comunidades as $com)
                @php($i++)
                    <tr>
                        <th scope="row">{{ $i }}</th>
                        <td>
                            {{ $com->nombre }}
                            
                        </td>
                        <td>
                            <small>{{ count($com->ninios) }} ninios</small>
                        </td>
                        <td>
                            <a href="{{ route('qrsNinioPdf',$com->id) }}" class="dropdown-item"><i class="fas fa-file-pdf"></i> Descargar Códigos Qrs</a>
                        </td>
                    </tr>    
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>


@push('linksCabeza')

@endpush

@prepend('linksPie')
    <script>
        $('#menuNinios').addClass('active');

    </script>
@endprepend

@endsection
