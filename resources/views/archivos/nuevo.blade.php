@extends('layouts.app',['title'=>'Nuevo archivo'])

@section('breadcrumbs', Breadcrumbs::render('nuevoArchivo'))

@section('barraLateral')

@endsection

@section('content')
<form action="{{ route('guardarArchivo') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">
            <div class="form-group">
                <label for="nombre">Nombre de archivo</label>
                <input type="text" name="nombre" class="form-control" id="nombre" value="{{ old('nombre') }}" placeholder="Ingrese nombre de archivo.." required>
              </div>
            <div class="form-group">
                <label for="archivo">Selecionar archivo</label>
                <input type="file" class="form-control" id="archivo" name="archivo" value="" aria-describedby="archivoayuda" required accept=".xlsx, .xls, .csv">
            </div>
        </div>
        <div class="card-body">

            

            @if (count($users))
                
            <div class="form-group">
                <label for="users">Selecione usuarios a compartir...</label>
                <select id="users" name="users[]" class="selectpicker form-control  show-tick" data-actions-box="true" data-live-search="true" data-header="Selecione usuarios a compartir..." title="Selecione usuarios a compartir..." data-selected-text-format="count > 3" multiple required>
                    @foreach ($users as $u)
                        <option value="{{ $u->id }}" {{ (collect(old('users'))->contains($u->id)) ? 'selected':'' }} data-tokens="{{ $u->identificacion }}" data-subtext="{{ $u->email }}">{{ $u->name }}</option>    
                    @endforeach
                    
                </select>
            </div>
            @else
            <div class="alert alert-info" role="alert">
                <strong>No exciste usuarios, para compartir achivo</strong>
            </div>
            @endif

            <div class="form-group">
                <label for="descripcion">Descripción...</label>
                <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Ingrese una descripción">{{ old('descripcion') }}</textarea>
            </div>
              
        </div>
        <div class="card-footer text-muted">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</form>

@push('linksCabeza')
<link rel="stylesheet" href="{{ asset('admin/plus/select/css/bootstrap-select.min.css') }}">
<script src="{{ asset('admin/plus/select/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('admin/plus/select/js/lg/defaults-es_ES.min.js') }}"></script>
@endpush

@prepend('linksPie')


  <script>
      $('#menuArchivos').addClass('active');
      
  </script>
@endprepend

@endsection
