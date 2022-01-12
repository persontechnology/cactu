@extends('layouts.app',['title'=>'Importar usuarios'])

@section('breadcrumbs', Breadcrumbs::render('usuariosImportar'))

@section('content')

<form method="POST" action="{{ route('procesarImportacionUsuarios') }}" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">
            
            <p><strong class="text-warning">Advertencia:</strong> El archvio excel debe regirse <strong>extrictamente</strong> al formato presentado a continuación.</p>
            <p>Por favor, elimine la primera fila del encabezado, cuando vaya subir la información</p>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr class="bg-dark">
                        <th scope="col">Nombre de usuario</th>
                        <th scope="col">Email</th>
                        <th scope="col">Identificacíon <small>(# de cédula)</small></th>
                        <th scope="col">Contraseña</th>
                        <th scope="col">Rol</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Pepito</td>
                        <th scope="row">pepito@gmail.com</th>
                        <th scope="row">0503652349</th>
                        <td>pepito02</td>
                        <td>Gestor</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="card-body">
                
            <div class="form-group">
                <label for="exampleFormControlFile1">Selecionar archivo que contenga información de usuarios</label>
                <input type="file" name="archivo" class="form-control-file" id="exampleFormControlFile1" required>
            </div>
                
        </div>
        <div class="card-footer text-muted">
            <button type="submit" class="btn btn-primary">Importar usuarios <i class="icon-paperplane ml-2"></i></button>
        </div>
    </div>
</form>

@push('linksCabeza')
  
@endpush

@prepend('linksPie')
    <script>
        $('#menuUsuarios').addClass('active');
    </script>
@endprepend

@endsection
