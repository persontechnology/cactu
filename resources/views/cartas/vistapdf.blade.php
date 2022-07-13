@if (Storage::disk('public')->exists('cartas/' . $buzonCarta->archivo))
    <h5 class="card-title">De parte de tu patrocinador</h5>
    <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="{{ Storage::url('cartas/' . $buzonCarta->archivo) }}"
            allowfullscreen></iframe>
    </div>
@endif
