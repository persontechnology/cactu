@extends('layouts.app',['title'=>'Nuevo usuario'])

@section('breadcrumbs', Breadcrumbs::render('usuariosNuevo'))



@section('content')
<form method="POST" action="{{ route('guardarUsuario') }}">
    @csrf
    <div class="card">
        <div class="card-header">
            Complete información
        </div>
        <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
            
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}<i class="text-danger">*</i></label>
        
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}<i class="text-danger">*</i></label>
        
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
        
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="identificacion" class="col-md-4 col-form-label text-md-right">Identificación<i class="text-danger">*</i></label>
            
                            <div class="col-md-6">
                                <input id="identificacion" type="identificacion" class="form-control @error('identificacion') is-invalid @enderror" name="identificacion" value="{{ old('identificacion') }}" required autocomplete="identificacion">
            
                                @error('identificacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
        
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}<i class="text-danger">*</i></label>
        
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
        
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}<i class="text-danger">*</i></label>
        
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
            
                        
                    </div>
                    <div class="col-md-4">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th scope="col">Rol</th>
                                    <th scope="col">Asignar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $rol)
                                        <tr>
                                            <th scope="row">{{ $rol->name }}</th>
                                            <td>
                                                <input class="opcionPermisos" name="roles[{{ $rol->id }}]" {{ old('roles.'.$rol->id)==$rol->id ?'checked':'' }} value="{{ $rol->id }}" type="checkbox"   data-toggle="toggle" data-on="SI" data-off="NO" data-onstyle="success" data-offstyle="danger" data-size="xs">
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
        <div class="card-footer text-muted">
                <button type="submit" class="btn btn-primary" >
                    {{ __('Guardar') }} <i class="icon-paperplane ml-2"></i>
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
        $('#menuUsuarios').addClass('active');
    </script>
    
@endprepend

@endsection
