<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="card-title text-capitalize mb-0">
                {{ $name }}
            </h2>
            @if($type != "show")
            <div class="d-flex justify-content-between gap-2">
                <a class="btn btn-warning" href="{{ route("spells.edit", $selfSpell) }}">Modifica</a>
                <button type="button" class="btn btn-danger px-1 py-0" data-bs-toggle="modal"
                    data-bs-target="#deleteModal-{{ $selfSpell->id }}">
                    Elimina
                </button>
            </div>
            @endif

        </div>
        <hr>
        <h5 class="card-subtitle my-2">
            Livello Spell: {{ $level }}
        </h5>
        <h5 class="card-subtitle my-2">
            Tempo di Cast: {{ $casting_time }}
        </h5>
        <h5 class="card-subtitle my-2">
            Range: {{ $range }}
        </h5>
        <h5 class="card-subtitle my-2">
            Componenti: {{ $components }}
        </h5>
        <h5 class="card-subtitle my-2">
            Durata: {{ $duration }}
        </h5>
        <hr>
        <a class="btn btn-primary" href="{{ route('spells.show', $selfSpell) }}">Visualizza</a>
    </div>
</div>

@if($type != "show")
<div class="modal fade" id="deleteModal-{{ $selfSpell->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Elimina la spell?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler eliminare la spell: <span class="text-capitalize">
                    {{ $selfSpell->name }}
                </span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <form action="{{ route('spells.destroy', $selfSpell) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <input type="submit" class="btn btn-danger" value="Elimina Definitivamente">
                </form>
            </div>
        </div>
    </div>
</div>
@endif