@extends('layouts.app',['title'=>'Restablecer contraseña'])
@section('breadcrumbs', Breadcrumbs::render('restablecerPassword'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border border-primary">
                <div class="card-header bg-primary">
                    {{ __('Reset Password') }}
                </div>

                <div class="card-body">
                    
                    <div class="row">
                            <div class="col-md-4">
                                    <img src="{{ asset('img/cactu.png') }}" alt="" class="card-img-top d-none d-sm-block img-fluid"  >
                            </div>
                            <div class="col-md-8">
                                @if (session('status'))
                                    
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ session('status') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Send Password Reset Link') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        $('#menuLogin').addClass('active')
    </script>
@endsection
