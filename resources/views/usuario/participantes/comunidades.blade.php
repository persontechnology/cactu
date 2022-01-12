@if (count($user->participantes)>0)
    @foreach ($user->participantes as $ninio)
    {{ $ninio->nombre }}, 
    @endforeach
@else
<span class="badge badge-warning">Sin comunidades</span>
@endif