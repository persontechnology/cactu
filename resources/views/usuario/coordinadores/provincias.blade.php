@if(count($user->provincias)>0)
@foreach ($user->provincias as $pro)
    {{ $pro->nombre }}
@endforeach
@else
<span class="badge badge-warning">Sin provincias</span>
@endif