
@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1>Modifica il personaggio: {{ $character->name }}</h1>
        <form method="POST" action="{{ route('characters.edit2', $character) }}" class="form-control mb-4 d-flex flex-column">
            @csrf
            <label class="form-label" for="name" >Nome</label>
            <input required class="form-control" type="text" name="name" id="name" value="{{ $character->name }}">
            <label class="form-label" for="level">Livello</label>
            <input required class="form-control" type="number" min="1" max="20" name="level" id="level" value="{{ $character->level }}">
            <label class="form-label" for="species_id">Razza</label>
            <select class="form-select" id="species_id" name="species_id">
                @foreach($species as $specie)
                <option {{ $character->species_id == $specie->id ? "selected" : ""}} value="{{ $specie->id }}">{{ $specie->name }}</option>
                @endforeach
            </select>
            <label class="form-label" for="profession_id">Classe</label>
            <select class="form-select" id="profession_id" name="profession_id">
                @foreach($professions as $profession)
                <option {{ $character->profession_id == $profession->id ? "selected" : "" }} value="{{ $profession->id }}">{{ $profession->name }}</option>
                @endforeach
            </select>
            <label class="form-label" for="background_id">Background</label>
            <select class="form-select" id="background_id" name="background_id">
                @foreach($backgrounds as $background)
                <option {{ $character->background_id == $background->id ? "selected" : "" }} value="{{ $background->id }}">{{ $background->name }}</option>
                @endforeach
            </select>
            <input class="btn btn-primary my-2" type="submit" value="Vai al prossimo step">
        </form>
    </div>
@endsection