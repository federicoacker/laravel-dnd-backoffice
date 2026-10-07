@extends('layouts.app')

@section('content')

    <h1 class="text-center text-capitalize">{{ $spell->name }}</h1>
    <div class="container">
        <div class="card px-3 py-2">
            <div class="card-subtitle">
                Livello Spell: {{ $spell->level }}
            </div>
            <div class="card-subtitle">
                Tempo di Cast: <span class="text-capitalize">{{ $spell->casting_time }}</span>
            </div>
            <div class="card-subtitle">
                Range: {{ $spell->range }}
            </div>
            <div class="card-subtitle">
                Componenti: {{ $spell->components }}
            </div>
            <div class="card-subtitle">
                Durata: {{ $spell->duration }}
            </div>
            <hr>
            <div class="card-text">
                {{ $spell->description }}
            </div>
        </div>

        <div class="d-flex justify-content-center gap-2 mt-4">
                <a class="btn btn-warning" href="{{ route("spells.edit", $spell) }}">Modifica</a>
                <button type="button" class="btn btn-danger px-1 py-0" data-bs-toggle="modal"
                    data-bs-target="#deleteModal-{{ $spell->id }}">
                    Elimina
                </button>
            </div>
    </div>

    <div class="modal fade" id="deleteModal-{{ $spell->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Elimina la spell?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler eliminare la spell: <span class="text-capitalize">
                    {{ $spell->name }}
                </span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <form action="{{ route('spells.destroy', $spell) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <input type="submit" class="btn btn-danger" value="Elimina Definitivamente">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection