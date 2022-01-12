@if(count($usuario->comunidades)>0)
@foreach ($usuario->comunidades as $com)
    {{ $com->nombre }},
@endforeach
@else
<span class="badge badge-warning">Sin comunidades</span>
@endcan