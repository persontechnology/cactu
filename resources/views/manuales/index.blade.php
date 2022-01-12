@extends('layouts.app',['title'=>'Manuales'])

@section('breadcrumbs', Breadcrumbs::render('manuales'))

@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Manual de usuario</h5>            
    </div>  
<div class="card-body">
    Revise su carpeta de manual de usuario por favor.
</div>
</div>

@endsection
@push('linksCabeza')


@endpush