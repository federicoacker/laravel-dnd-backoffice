<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="card-title text-capitalize mb-0">
                    {{ $name }}
                </h2>
            </div>
            <div class="d-flex justify-content-between gap-2">
                <a class="btn btn-warning" href="{{ route("species.edit", $selfSpecies) }}">Modifica</a>
                <button type="button" class="btn btn-danger px-1 py-0" data-bs-toggle="modal"
                    data-bs-target="#deleteModal-{{ $selfSpecies->id }}">
                    Elimina
                </button>
            </div>
        </div>
        <hr>
        @if ($selfSpecies->image)
            <img class="card-img-top" src="{{ asset('storage/' . $selfSpecies->image) }}"
                alt="Immagine {{ $selfSpecies->name }}">
            <hr>
        @endif
        @if ($selfSpecies->features)
        <h5 class="card-subtitle">Feature Razziali: </h5>
        <ul class="species-features">
            @foreach ($selfSpecies->features as $feature)
                <li class="card-subtitle"><h5><a href={{ route('features.show', $feature) }}>{{ $feature->name }}</a></h5></li>
            @endforeach
        </ul>
        <hr>
        @endif
        <a class="btn btn-primary" href="{{ route('species.show', $selfSpecies) }}">Visualizza</a>
    </div>
</div>

<div class="modal fade" id="deleteModal-{{ $selfSpecies->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Elimina la specie?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler eliminare la specie: <span class="text-capitalize">
                    {{ $selfSpecies->name }}
                </span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <form action="{{ route('species.destroy', $selfSpecies) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <input type="submit" class="btn btn-danger" value="Elimina Definitivamente">
                </form>
            </div>
        </div>
    </div>
</div>