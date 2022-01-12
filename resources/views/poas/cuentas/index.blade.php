@extends('layouts.app',['title'=>'Administración'])

@section('breadcrumbs', Breadcrumbs::render('poaCuentaContable',$poa))

@section('barraLateral')
    <div class="breadcrumb justify-content-center">

    </div>
@endsection

@section('content')

<ul class="nav nav-tabs nav-tabs-solid bg-primary-400 border-0">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Descripción <i class="icon-menu7 mr-2"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="cuentaContable-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Cuentas Contables
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="meses-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Meses <i class=" icon-calendar52 mr-2"></i>
        </a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <form action="{{ route('actualizarPoaCuenta') }}" method="POST">   
            @csrf
            <input type="hidden" name="poa" value="{{ $poa->id }}">
            <div class="card">
                <div class="card-header">
                    Descripción
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" required  placeholder="Ingrese descripción..">{{ old('descripcion',$poa->poaCuentaContable->descripcion??'') }}</textarea>
                        @error('descripcion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <button class="btn btn-primary" type="submit">Guardar <i class="icon-paperplane ml-2"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <form action="{{ route('actualizarPoaContbleCunetasContables') }}" method="POST">
            @csrf
            <input type="hidden" name="poa" value="{{ $poa->id }}">
            <div class="card">
                <div class="card-header">
                    Cuentas contables
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <select class="form-control milista" id="cunetasContables" name="cunetasContables[]" multiple>
                            @foreach ($cuentasNo as $cuentasNo)
                                <option value="{{ $cuentasNo->id }}">{{ $cuentasNo->nombre }}</option>
                            @endforeach
                            @foreach ($cuentasSi as $cuentasSi)
                                <option value="{{ $cuentasSi->id }}" selected>{{ $cuentasSi->nombre }}</option>
                            @endforeach
                        </select>
                    </div>                    
                </div>
                <div class="card-footer text-muted">
                    <button class="btn btn-primary" type="submit">Guardar <i class="icon-paperplane ml-2"></i></button>
                </div>
            </div>
        </form>
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">      
    <div class="card">
         <div class="card-header header-elements-inline">
            <h6 class="card-title">Lista de cuentas contables</h6>
            <div class="header-elements">
                <div class="list-icons">
                                      
                    <a class="list-icons-item" data-action="fullscreen"></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($poa->poaActividad)
            @if (count($poa->poaActividad->meses)>0)
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            @foreach ($poa->poaActividad->meses as $mh_a)
                                <th scope="col">{{ $mh_a->mes }}</th>
                            @endforeach
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>           
                            @foreach ($poa->poaActividad->meses as $mb_a)
                            <th scope="row">
                                {{ $mb_a->poaActividadMes->valor }}
                            </th>
                            @endforeach
                            <td>
                                {{ 
                                    $poa->poaActividad->meses->sum('poaActividadMes.valor')
                                 }}
                            </td>    
                        </tr>
                    </tbody>
                </table> 
            </div>   
            @else
                <p>no tiene meses</p>
            @endif
            @else
            <div class="alert alert-primary">
                <span class="font-weight-semibold">Sin cuentas contables</span>
            </div>
            @endif
            <br>
             @if($cuentasSi->count()>0)
        <!-- Inner container -->
        <div class="d-flex align-items-start flex-column flex-md-row">
                <!-- Left content -->
                <div class="w-100 overflow-auto order-2 order-md-1">
            @foreach($poa->poaCuentaContable->CuentaContablePoaCuentas as $cuenta)

                    <!-- Questions list -->
                    <div class="card-group-control card-group-control-right">
                        <div class="card mb-2">
                            <div class="card-header bg-dark ">
                                <h6 class="card-title text-white">
                                    <a class="text-default collapsed text-white" data-toggle="collapse" href="#question_{{$cuenta->id}}">
                                        <i class="icon-coin-dollar mr-2 text-white"></i>  {{$cuenta->cuentaContable->nombre}}
                                    </a>
                                </h6>
                            </div>

                            <div id="question_{{$cuenta->id}}" class="collapse">
                                <div class="card-body">
                                    <form action="{{route('actualizarValorMesPoaCuenta')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="cuentaContable" value="{{$cuenta->id}}" required>
                                        <div class="table-responsive">
                                          <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        @foreach ($cuenta->meses as $mh)
                                                        <th scope="col">{{ $mh->mes }}</th>
                                                        @endforeach
                                                        <th>Total</th>                                          
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>          
                                                      @foreach ($cuenta->meses as $mb)
                                                          <th >
                                                              
                                                            @php($poa_item=$mb->poaCuentaContableMesPorId($mb->poaCuentaContableMes->id)->cuentaContablePoaCuenta->poaContable->poa)
                                                                <input type="hidden" name="poaContMes[{{ $mb->poaCuentaContableMes->id }}]" value="{{ $mb->poaCuentaContableMes->id }}">
                                                                @if ($poa_item->poaActividad->mesesXmes($mb->mes))
                                                                    <input style="width: 100px;" type="number" min="0" max="10000"  step="any" name="valores[{{ $mb->poaCuentaContableMes->id }}]"  value="{{ $mb->poaCuentaContableMes->valor }}" class="wmin-ms-200 form-control form-control-sm border-success" required>
                                                                @else
                                                                    <input style="width: 100px;" type="number" min="0" max="10000"  step="any" name="valores[{{ $mb->poaCuentaContableMes->id }}]"  value="{{ $mb->poaCuentaContableMes->valor }}" class="wmin-ms-200 form-control form-control-sm border-warning" required>
                                                                @endif
                                                          </th>

                                                      @endforeach
                                                      <td>
                                                          {{ 
                                                              $cuenta->meses->sum('poaCuentaContableMes.valor')
                                                           }}
                                                      </td>
                                                  </tr>                                  
                                                </tbody>
                                            </table> 
                                            <strong>Nota:</strong>
                                            Solo el campo de color verde tiene planificación, donde puede agregar # Valor económico por mes.
                                            </small>
                                        </div> 
                                        <div class="btn-group text-center ml-5" role="group" aria-label="Basic example">
                                            <button type="submit" class="btn btn-primary">
                                               Guardar <i class="icon-paperplane ml-2"></i>
                                            </button>
                                            <a  class="btn btn-danger text-white" onclick="eliminar(this);" data-id="{{ $cuenta->id }}" >
                                               Eliminar <i class="fas fa-trash-alt ml-2"></i>
                                            </a>                      
                                        </div> 
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>


             @endforeach
                </div>
            <!-- /left content -->
        </div>
       @endif
        </div>
    </div>
       
  </div>
</div>


      
@push('linksCabeza')

{{--  dual select  --}}
<link rel="stylesheet" href="{{ asset('admin/plus/dual-listbox/bootstrap-duallistbox.min.css') }}">

<script src="{{ asset('admin/plus/dual-listbox/jquery.bootstrap-duallistbox.min.js') }}"></script>

{{--  toogle  --}}
<link href="{{ asset('admin/plus/bootstrap4-toggle/css/bootstrap4-toggle.min.css') }}" rel="stylesheet">
<script src="{{ asset('admin/plus/bootstrap4-toggle/js/bootstrap4-toggle.min.js') }}"></script>
@endpush

@prepend('linksPie')
    <script>
         
        $('#menuPlanificacion').addClass('active');
         @if (session('tabsCuenta'))
            $('#{{ session('tabsCuenta') }}').tab('show')
        @endif

         $('.milista').bootstrapDualListbox({
            nonSelectedListLabel: '<strong>Sin asignar</strong>',
            selectedListLabel: '<strong>Asignadas</strong>',
            moveOnSelect: false,
            filterTextClear:'Mostrar todo',
            filterPlaceHolder:'Filtrar..',
            moveSelectedLabel:'Mover selecionado',
            moveAllLabel:'Mover todos',
            removeSelectedLabel:'Eliminar selección',
            removeAllLabel:'Eliminar todo',
            infoText:'Mostrando todo {0}',
            infoTextFiltered:'<span class="label label-warning">Filtrado</span> {0} desde {1}',
            infoTextEmpty:'Lista vacía'
          });
    </script>
    <script type="text/javascript">
        
        function eliminar(arg){
        
            var id=$(arg).data('id');
            swal({
                title: "¿Estás seguro?",
                text: "Tu no podrás recuperar esta información.!",
                type: "error",
                showCancelButton: true,
                confirmButtonClass: "btn-success",
                cancelButtonClass: "btn-danger",
                confirmButtonText: "¡Sí, bórralo!",
                cancelButtonText:"Cancelar",
                closeOnConfirm: false
            },
            function(){
                swal.close();
                $.blockUI({message:'<h1>Espere por favor.!</h1>'});
                $.post( "{{ route('eliminarValorMesPoaCuenta') }}", { cuentaContable: id })
                 location.reload();   
            });
        }
    </script>

@endprepend

@endsection
