@extends('layouts.app',['title'=>'Actualizar usuario'])

@section('breadcrumbs', Breadcrumbs::render('editarUsuario',$usuario))


@section('content')
<form method="POST" action="{{ route('actualizarUsuario') }}">
    @csrf
    <input type="hidden" name="usuario" value="{{ $usuario->id }}" required>
    <div class="card">
        <div class="card-header">
            Complete información
        </div>
        <div class="card-body">
               
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}<i class="text-danger">*</i></label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$usuario->name) }}" required autocomplete="name" autofocus>

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
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',$usuario->email) }}" required autocomplete="email">

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
                    <input id="identificacion" type="identificacion" class="form-control @error('identificacion') is-invalid @enderror" name="identificacion" value="{{ old('identificacion',$usuario->identificacion) }}" required autocomplete="identificacion">

                    @error('identificacion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>

                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="estado" id="estado1" value="1" {{ $usuario->estado==true?'checked':'' }}>
                        <label class="form-check-label" for="estado1">
                            Activo
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="estado" id="estado2" value="0" {{ $usuario->estado==false?'checked':'' }}>
                        <label class="form-check-label" for="estado2">
                            Inactivo
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
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">{{ __('Actualizar') }} <i class="icon-paperplane ml-2"></i></button>
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
