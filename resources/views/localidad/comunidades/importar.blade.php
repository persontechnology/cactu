@extends('layouts.app',['title'=>'Importar comunidades'])

@section('breadcrumbs', Breadcrumbs::render('importarComunidades'))

@section('content')

<form method="POST" action="{{ route('procesarImportacionComunidades') }}" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">
            
            <p><strong class="text-warning">Advertencia:</strong> El archvio excel debe regirse <strong>extrictamente</strong> al formato presentado a continuación.</p>
            <p>Por favor, elimine la primera fila del encabezado, cuando vaya subir la información</p>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr class="bg-dark">
                        <th scope="col">Nombre de Cantón</th>
                        <th scope="col">Nombre de comunidad</th>
                        <th scope="col">Email de usuario gestor</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>SALCEDO</td>
                        <th scope="row">SANTA ANA</th>
                        <td>pepito@gmail.com</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="card-body">
                
            <div class="form-group">
                <label for="exampleFormControlFile1">Selecionar archivo que contenga información de comunidades</label>
                <input type="file" name="archivo" class="form-control-file" id="exampleFormControlFile1" required>
            </div>
                
        </div>
        <div class="card-footer text-muted">
            <button type="submit" class="btn btn-primary">Importar comunidades <i class="icon-paperplane ml-2"></i></button>
        </div>
    </div>
</form>

@push('linksCabeza')
  
@endpush

@prepend('linksPie')
    <script>
        $('#menuLocalidad').addClass('nav-item-expanded nav-item-open');
        $('#menuComunidad').addClass('active');
    </script>
@endprepend

@endsection
