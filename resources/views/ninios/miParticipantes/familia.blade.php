@extends('layouts.app',['title'=>'Familiares del participante'])
@section('breadcrumbs', Breadcrumbs::render('familiaMiParticipante',$ninio))

@section('content')

<form action="{{route('guardarFamiliaMiParticipantes')}}" method="post">
    @csrf
    <div class="card">
        <div class="card-header">
            Familiares del participante: <span class="text-uppercase font-size-sm font-weight-bold">{{$ninio->nombres}}</span>
        </div>
        <div class="card-body">

            <input type="hidden" value="{{$ninio->id}}" name="ninio" id="ninio">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3">Papá</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                </span>
                                <input type="text" value="{{ isset($ninio->familia->papa) ? $ninio->familia->papa : '' }}" name="papa" id="papa" class="form-control" placeholder="Ingrese papá">
                            </div>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3">Mamá</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                </span>
                                <input type="text" value="{{ isset($ninio->familia->mama) ? $ninio->familia->mama : '' }}" name="mama" id="mama" class="form-control" placeholder="Ingrese mamá">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3">Representante</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                </span>
                                <input type="text" value="{{ isset($ninio->familia->otro1) ? $ninio->familia->otro1 : '' }}" required name="otro1" id="otro1" class="form-control" placeholder="Ingrese Representante">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3">N° Celular</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-iphone"></i></span>
                                </span>
                                <input type="tel" value="{{ isset($ninio->familia->otro2) ? $ninio->familia->otro2 : '' }}" name="otro2" id="otro2" class="form-control" placeholder="Ingrese celular">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3">E-mail</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-envelope"></i></span>
                                </span>
                                <input type="email" value="{{ isset($ninio->familia->otro3) ? $ninio->familia->otro3 : '' }}" name="otro3" id="otro3" class="form-control" placeholder="Ingrese email">
                            </div>
                        </div>
                    </div>
                    {{--  <div class="form-group row">
                        <label class="col-form-label col-lg-3">Abuelo</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                </span>
                                <input type="text" value="{{ isset($ninio->familia->abuelo) ? $ninio->familia->abuelo : '' }}" name="abuelo" id="abuelo" class="form-control" placeholder="Ingrese abuelo">
                            </div>
                        </div>
                    </div>  --}}
{{--              
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">Abuela</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                </span>
                                <input type="text" value="{{ isset($ninio->familia->abuela) ? $ninio->familia->abuela : '' }}" name="abuela" id="abuela" class="form-control" placeholder="Ingrese abuela">
                            </div>
                        </div>
                    </div>  --}}
                

                    {{--  <div class="form-group row">
                        <label class="col-form-label col-lg-3">Ti@</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                </span>
                                <input type="text" value="{{ isset($ninio->familia->tio) ? $ninio->familia->tio : '' }}" name="tio" id="tio" class="form-control" placeholder="Ingrese tio">
                            </div>
                        </div>
                    </div>  --}}
                    {{--  <div class="form-group row">
                        <label class="col-form-label col-lg-3">Cuñad@</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                </span>
                                <input type="text" value="{{ isset($ninio->familia->cunado) ? $ninio->familia->cunado : '' }}" name="cunado" id="cunado" class="form-control" placeholder="Ingrese cuñad@">
                            </div>
                        </div>
                    </div>  --}}
                    {{--  <div class="form-group row">
                        <label class="col-form-label col-lg-3">Sobrin@/Prim@</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                </span>
                                <input type="text" value="{{ isset($ninio->familia->sobrino) ? $ninio->familia->sobrino : '' }}" name="sobrino" id="sobrino" class="form-control" placeholder="Ingrese Sobrin@/Prim@">
                            </div>
                        </div>
                    </div>  --}}


                </div>
                <div class="col-sm-6">                
                    {{--  <div class="form-group row">
                        <label class="col-form-label col-lg-3">Hermano 1</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                </span>
                                <input type="text" value="{{ isset($ninio->familia->hermano1) ? $ninio->familia->hermano1 : '' }}" name="hermano1" id="hermano1" class="form-control" placeholder="Ingrese hermano 1">
                            </div>
                        </div>
                    </div>  --}}
                    {{--  <div class="form-group row">
                        <label class="col-form-label col-lg-3">Hermano 2</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                </span>
                                <input type="text" value="{{ isset($ninio->familia->hermano2) ? $ninio->familia->hermano2 : '' }}" name="hermano2" id="hermano2" class="form-control" placeholder="Ingrese hermano 2">
                            </div>
                        </div>
                    </div>  --}}
                    {{--  <div class="form-group row">
                        <label class="col-form-label col-lg-3">Hermano 3</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                </span>
                                <input type="text" value="{{ isset($ninio->familia->hermano3) ? $ninio->familia->hermano3 : '' }}" name="hermano3" id="hermano3" class="form-control" placeholder="Ingrese hermano 3">
                            </div>
                        </div>
                    </div>  --}}
                    {{--  <div class="form-group row">
                        <label class="col-form-label col-lg-3">Hermano 4</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                </span>
                                <input type="text" value="{{ isset($ninio->familia->hermano4) ? $ninio->familia->hermano4 : '' }}" name="hermano4" id="hermano4" class="form-control" placeholder="Ingrese hermano 4">
                            </div>
                        </div>
                    </div>  --}}
                    {{--  <div class="form-group row">
                        <label class="col-form-label col-lg-3">Hermano 5</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                </span>
                                <input type="text" value="{{ isset($ninio->familia->hermano5) ? $ninio->familia->hermano5 : '' }}" name="hermano5" id="hermano5" class="form-control" placeholder="Ingrese hermano 5">
                            </div>
                        </div>
                    </div>  --}}
                    {{--  <div class="form-group row">
                        <label class="col-form-label col-lg-3">Hermano 6</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                </span>
                                <input type="text" value="{{ isset($ninio->familia->hermano6) ? $ninio->familia->hermano6 : '' }}" name="hermano6" id="hermano6" class="form-control" placeholder="Ingrese hermano 6">
                            </div>
                        </div>
                    </div>  --}}
                    {{--  <div class="form-group row">
                        <label class="col-form-label col-lg-3">Hermano 7</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                </span>
                                <input type="text" value="{{ isset($ninio->familia->hermano7) ? $ninio->familia->hermano7 : '' }}" name="hermano7" id="hermano7" class="form-control" placeholder="Ingrese hermano 7">
                            </div>
                        </div>
                    </div>  --}}
                    {{--  <div class="form-group row">
                        <label class="col-form-label col-lg-3">Hermano 8</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                </span>
                                <input type="text" value="{{ isset($ninio->familia->hermano8) ? $ninio->familia->hermano8 : '' }}" name="hermano8" id="hermano8" class="form-control" placeholder="Ingrese hermano 8">
                            </div>
                        </div>
                    </div>  --}}

                    {{--  <div class="form-group row">
                        <label class="col-form-label col-lg-3">Maestr@</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                </span>
                                <input type="text" value="{{ isset($ninio->familia->maestro) ? $ninio->familia->maestro : '' }}" name="maestro" id="maestro" class="form-control" placeholder="Ingrese Maestr@">
                            </div>
                        </div>
                    </div>  --}}

                </div> 
            </div>     

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Actualizar <i class="icon-paperplane ml-2"></i></button>
        </div>
    </div>
</form>

@push('linksCabeza')
{{-- phone --}}
<link rel="stylesheet" href="{{ asset('admin/plus/build-phone/css/intlTelInput.min.css') }}">
<script src="{{ asset('admin/plus/build-phone/js/intlTelInput.min.js') }}"></script>
<script src="{{ asset('admin/plus/build-phone/js/intlTelInput-jquery.min.js') }}"></script>
@endpush

@prepend('linksPie')


    <script>
        $('#misParticipantes').addClass('active');
        var instance= $('#otro2').intlTelInput({
            autoHideDialCode:false,
            nationalMode:false,
            placeholderNumberType:"MOBILE",
            preferredCountries: ["ec" ],
            separateDialCode:false,
        });
    </script>
@endprepend

@endsection