<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="card-title text-capitalize mb-0">
                    {{ $selfProfession->name }}
                </h2>

            </div>
            <div class="d-flex justify-content-between gap-2">
                <a class="btn btn-warning" href="{{ route("classes.edit", $selfProfession) }}">Modifica</a>
                <button type="button" class="btn btn-danger px-1 py-0" data-bs-toggle="modal"
                    data-bs-target="#deleteModal-{{ $selfProfession->id }}">
                    Elimina
                </button>
            </div>

        </div>
        @if ($selfProfession->image)
            <hr>
            <img src="{{ asset('storage/' . $selfProfession->image) }}" alt="Immagine {{ $selfProfession->name }}"
                class="card-img-top class-card-img">
        @endif
        <hr>
        <a class="btn btn-primary" href="{{ route('classes.show', $selfProfession) }}">Visualizza</a>
    </div>
</div>

<div class="modal fade" id="deleteModal-{{ $selfProfession->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Elimina la feature?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler eliminare la Classe: <span class="text-capitalize">
                    {{ $selfProfession->name }}
                </span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <form action="{{ route('classes.destroy', $selfProfession) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <input type="submit" class="btn btn-danger" value="Elimina Definitivamente">
                </form>
            </div>
        </div>
    </div>
</div>