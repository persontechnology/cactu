@if (Storage::exists($ar->url))
    <a href="{{ Storage::url($ar->url) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Descargar">
        <i class="fas fa-download"></i>
    </a>
@endif