@extends('layouts.app')

@section('content')
    <div class="my-4">

        <h1 class="text-center text-capitalize">{{ $background->name }}</h1>
        <div class="container">

            <hr>
            <h2>Abilità associate:</h2>
            <div class="card-text">
                @php
                    $ability_scores = explode(",", $background->ability_scores); 
                @endphp
                <ul class="ability-scores">
                    @foreach($ability_scores as $ability)
                        <li class="card-text">{{ $ability }}</li>
                    @endforeach
                </ul>
            </div>
            <h2>Proficiencies:</h2>
            <div class="card-text">
                <ul class="proficiencies">

                    @foreach($background->proficiencies as $proficiency)
                    <li ><a class="text-capitalize" href="{{ route('proficiencies.show', $proficiency) }}">{{ $proficiency->type }}: {{ $proficiency->name }} ({{ $proficiency->ability_score }})</a></li>
                    @endforeach
                </ul>
            </div>
            <hr>
            <h2>Descrizione:</h2>
            <div class="card-text">
                {{ $background->description }}
            </div>
            <hr>
            <h2>Equipaggiamento di base:</h2>
            <div class="card-text">
                {{ $background->equipment }}
            </div>
            @if($background->feat)
                <hr>
                <div class="card-title">
                    <h2>Feat:</h2>
                    <div class="container">
                        <h2 class="text-capitalize feat"><a href={{ route('feats.show', $background->feat) }}>{{ $background->feat->name }}</a>:</h2>
                        <p>{{ $background->feat->description }}</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="d-flex justify-content-center gap-2 mt-4">
            <a class="btn btn-warning" href="{{ route("backgrounds.edit", $background) }}">Modifica</a>
            <button type="button" class="btn btn-danger px-1 py-0" data-bs-toggle="modal"
                data-bs-target="#deleteModal-{{ $background->id }}">
                Elimina
            </button>
        </div>
    </div>
    </div>

    <div class="modal fade" id="deleteModal-{{ $background->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Elimina il background?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Sei sicuro di voler eliminare il background: <span class="text-capitalize">
                        {{ $background->name }}
                    </span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <form action="{{ route('backgrounds.destroy', $background) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="submit" class="btn btn-danger" value="Elimina Definitivamente">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection