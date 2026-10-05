@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4">

            <h1 class="text-center text-capitalize">{{ $proficiency->name }}</h1>
            <hr>
            <h5 class="text-center text-capitalize">Tipo di Proficiency: {{ $proficiency->type }}</h5>
            @if($proficiency->ability_score)
            <h5 class="text-center text-capitalize">Abilità associata: {{ $proficiency->ability_score }}</h5>
            @endif
            <hr>
            <div class="container">
                <div class="card-text">
                    {{ $proficiency->description }}
                </div>
            </div>

            <div class="d-flex justify-content-center gap-2 mt-4">
                <a class="btn btn-warning" href="{{ route("proficiencies.edit", $proficiency) }}">Modifica</a>
                <button type="button" class="btn btn-danger px-1 py-0" data-bs-toggle="modal"
                    data-bs-target="#deleteModal-{{ $proficiency->id }}">
                    Elimina
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal-{{ $proficiency->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Elimina la proficiency?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Sei sicuro di voler eliminare la proficiency: <span class="text-capitalize">
                        {{ $proficiency->name }}
                    </span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <form action="{{ route('proficiencies.destroy', $proficiency) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="submit" class="btn btn-danger" value="Elimina Definitivamente">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection