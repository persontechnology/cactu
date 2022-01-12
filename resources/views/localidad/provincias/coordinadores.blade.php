@if (count($provincia->coordinadores)>0)
    @foreach ($provincia->coordinadores as $coor)
    {{ $coor->name }},
    @endforeach
@else
<span class="badge badge-warning">Sin coordinadores</span> 
@endif