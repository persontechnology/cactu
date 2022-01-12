@extends('layouts.app',['title'=>'Nuevo gestor'])

@section('breadcrumbs', Breadcrumbs::render('gestoresNuevo'))



@section('content')
<form method="POST" action="{{ route('guardarGestor') }}">
    @csrf
    <div class="card">
        <div class="card-header">
            Complete información
        </div>
        <div class="card-body">
            
                
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
        <div class="card-footer text-muted">
            <button class="btn btn-primary" type="submit">Guardar <i class="icon-paperplane ml-2"></i></button>
        </div>
    </div>
    
</form>


@push('linksCabeza')

@endpush

@prepend('linksPie')
    <script>
        $('#menuGestores').addClass('active');
    </script>
    
@endprepend

@endsection
