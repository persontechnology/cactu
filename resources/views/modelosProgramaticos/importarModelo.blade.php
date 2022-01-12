@extends('layouts.app',['title'=>'Importar modelos'])
@section('breadcrumbs', Breadcrumbs::render('importarModelo'))

@section('content')

<form method="POST" action="{{ route('procesarImportacionModelos') }}" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">
            
            <p><strong class="text-warning">Advertencia:</strong> El archvio excel debe regirse <strong>extrictamente</strong> al formato presentado a continuación.</p>
            <p>Por favor, elimine la primera fila del encabezado, cuando vaya subir la información</p>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr class="bg-dark">
                        <th scope="col">Nombre del modelo Programático</th>
                        <th scope="col">Código</th>                        
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Creciendo Contigo</td>
                        <th scope="row">IA</th>                        
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
            <button type="submit" class="btn btn-primary">Importar Modelos P. <i class="icon-paperplane ml-2"></i></button>
        </div>
    </div>
</form>

@push('linksCabeza')
  
@endpush

@prepend('linksPie')
    <script>
        $('#menuModeloProgramatico').addClass('active');
    </script>
@endprepend

@endsection
