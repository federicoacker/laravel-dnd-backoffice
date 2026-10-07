<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center gap-2 mb-2">
            <h2 class="card-title mb-0">{{ $selfCharacter->name }}</h2>
            <h2 class="card-subtitle mb-0 text-center">Livello: {{ $selfCharacter->level }}</h2>

        </div>
        <div class="d-flex justify-content-center gap-2">
            <a class="btn btn-warning" href="{{ route("characters.edit", $selfCharacter) }}">Modifica</a>
            <button type="button" class="btn btn-danger px-1 py-0" data-bs-toggle="modal"
                data-bs-target="#deleteModal-{{ $selfCharacter->id }}">
                Elimina
            </button>
        </div>
        <hr>
        @if($selfCharacter->image)
            <img src="{{ asset('storage/' . $selfCharacter->image) }}" alt="Immagine {{ $selfCharacter->name }}"
                class="card-img-top">
        @endif
        <section class="character-info d-flex flex-column gap-2">
            <h5 class="card-subtitle">Classe: <span
                    class="text-capitalize">{{ $selfCharacter->profession->name }}</span>
            </h5>
            <h5 class="card-subtitle">Razza: <span class="text-capitalize">{{ $selfCharacter->species->name }}</span>
            </h5>
            <h5 class="card-subtitle">Background: <span
                    class="text-capitalize">{{ $selfCharacter->background->name }}</span>
            </h5>
        </section>
        <a class="btn btn-primary" href="{{ route('characters.show', $selfCharacter) }}">Visualizza</a>
    </div>
</div>

<div class="modal fade" id="deleteModal-{{ $selfCharacter->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Elimina il personaggio?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler eliminare il Personaggio: <span class="text-capitalize">
                    {{ $selfCharacter->name }}
                </span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <form action="{{ route('characters.destroy', $selfCharacter) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <input type="submit" class="btn btn-danger" value="Elimina Definitivamente">
                </form>
            </div>
        </div>
    </div>
</div>