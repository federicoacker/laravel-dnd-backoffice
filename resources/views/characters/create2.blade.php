@extends('layouts.app')
@php
    $number_of_feats = floor($level / 4);
@endphp

@section('content')
    <div class="container py-4">
        <h1>Continua la creazione</h1>
        <form method="POST" action="{{ route('characters.store') }}" class="form-control mb-4 d-flex flex-column"
            enctype="multipart/form-data">
            @csrf

            <label class="form-label" for="name">Nome</label>
            <input required type="text" class="form-control" name="name" id="name" value="{{ $name }}">

            <label class="form-label" for="level">Livello</label>
            <input required type="number" class="form-control" name="level" id="level" value="{{ $level }}">

            <label class="form-label" for="species_id">Razza</label>
            <input required type="text" disabled class="form-control" id="species_id" value="{{ $species->name }}">
            <input required type="hidden" class="form-control" name="species_id" id="species_id" value="{{ $species->id }}">

            <label class="form-label" for="profession_id">Classe</label>
            <input required type="text" disabled class="form-control" id="profession_id" value="{{ $profession->name }}">
            <input required type="hidden" class="form-control" name="profession_id" id="profession_id"
                value="{{ $profession->id }}">

            <label class="form-label" for="background_id">Background</label>
            <input required type="text" disabled class="form-control" id="background_id" value="{{ $background->name }}">
            <input required type="hidden" class="form-control" name="background_id" id="background_id"
                value="{{ $background->id }}">

            <section class="container ability-scores my-4 ">
                <h2 class="text-center">Ability Scores:</h2>
                <div class="row row-cols-3 row-cols-xl-6 w-100">
                    <div class="col d-flex flex-column justify-content-center align-content-center ability-score">
                        <label for="strength" class="text-center form-label">Strength</label>
                        <input class="form-control" required type="number" min="1" max="20" name="strength" id="strength">
                    </div>
                    <div class="col d-flex flex-column justify-content-center align-content-center ability-score">
                        <label for="dexterity" class="text-center form-label">Dexterity</label>
                        <input class="form-control" required type="number" min="1" max="20" name="dexterity" id="dexterity">
                    </div>
                    <div class="col d-flex flex-column justify-content-center align-content-center ability-score">
                        <label for="constitution" class="text-center form-label">Constitution</label>
                        <input class="form-control" required type="number" min="1" max="20" name="constitution"
                            id="constitution">
                    </div>
                    <div class="col d-flex flex-column justify-content-center align-content-center ability-score">
                        <label for="intellect" class="text-center form-label">Intellect</label>
                        <input class="form-control" required type="number" min="1" max="20" name="intellect" id="intellect">
                    </div>
                    <div class="col d-flex flex-column justify-content-center align-content-center ability-score">
                        <label for="wisdom" class="text-center form-label">Wisdom</label>
                        <input class="form-control" required type="number" min="1" max="20" name="wisdom" id="wisdom">
                    </div>
                    <div class="col d-flex flex-column justify-content-center align-content-center ability-score">
                        <label for="charisma" class="text-center form-label">Charisma</label>
                        <input class="form-control" required type="number" min="1" max="20" name="charisma" id="charisma">
                    </div>
                </div>
            </section>
            <section class="proficiencies">
                <h2 class="text-center">Proficiencies da Background:</h2>
                <ul class="character-create-proficiencies">
                    @foreach($background->proficiencies()->orderBy('type')->get() as $background_proficiency)
                        <li>
                            <input class="form-control text-capitalize" type="text" disabled
                                value="{{ $background_proficiency->type }}: {{ $background_proficiency->name }} ({{ $background_proficiency->ability_score }})">
                            <input type="hidden" id="background_proficiencies" name="background_proficiencies[]"
                                value="{{ $background_proficiency->id }}">
                        </li>
                    @endforeach
                </ul>
                <h2 class="text-center">Proficiencies di Classe:</h2>
                <h3 class="text-center">Seleziona {{ $profession->number_of_proficiencies }} proficiencies da questa lista:
                </h3>
                <ul class="character-create-proficiencies">
                    @foreach($profession->proficiencies()->orderBy('type')->get() as $profession_proficiency)
                        <li>
                            <input {{ $background->proficiencies->contains($profession_proficiency->id) ? "checked disabled" : "" }} type="checkbox" id="profession_proficiency_{{$profession_proficiency->id}}"
                                name="profession_proficiencies[]" value="{{ $profession_proficiency->id }}">
                            <label class="form-label text-capitalize"
                                for="profession_proficiency_{{ $profession_proficiency->id }}">{{ $profession_proficiency->type }}:
                                {{ $profession_proficiency->name }} ({{ $profession_proficiency->ability_score }})</label>
                        </li>
                    @endforeach
                    @error('profession_proficiencies')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                </ul>
                <label class="form-label" for="armor_training">Proficiency Armature:</label>
                <textarea class="form-control" disabled name="armor_training" id="armor_training" class="card-text">
                    {{ $profession->armor_training }}
                </textarea>
            </section>
            <section class="features">
                <h2 class="species-features text-center">
                    Feature Razziali:
                </h2>
                <ul>
                    @foreach ($species->features as $feature)
                        <li>
                            <a class="text-capitalize" href="{{ route('features.show', $feature) }}">{{ $feature->name}}</a>
                            <p class="card-text">{{ $feature->description }}</p>
                        </li>
                    @endforeach
                </ul>
                <h2 class="species-features text-center">
                    Feature di Classe:
                </h2>
                <ul>
                    @foreach ($profession->features as $feature)
                        <li>
                            <a class="text-capitalize" href="{{ route('features.show', $feature) }}">{{ $feature->name}}</a>
                            <p class="card-text">{{ $feature->description }}</p>
                        </li>
                    @endforeach
                </ul>
                <h2 class="text-center">Feat da Background</h2>
                <ul>
                    @foreach ($background->feat()->get() as $feat)
                        <li>
                            <a class="text-capitalize" href="{{ route('feats.show', $feat) }}">{{ $feat->name}}</a>
                            <p class="card-text">{{ $feat->description }}</p>
                        </li>
                    @endforeach
                </ul>
                @if(count($profession->spells) > 0)
                    <h2 class="text-center">Spells:</h2>
                    <ul class="d-flex flex-wrap">
                        @foreach($profession->spells()->orderBy('level')->get() as $spell)
                            <li class="d-flex flex-column">
                                <a href="{{ route('spells.show', $spell) }}">{{ $spell->name }}</a>
                                <p class="card-text mb-0">Level: {{ $spell->level }}</p>
                                <p class="card-text mb-0">Components: {{ $spell->components }}</p>
                                <p class="card-text mb-0">Action: {{ $spell->action }}</p>
                                <p class="card-text mb-0">Duration: {{ $spell->duration }}</p>
                                <p class="card-text mb-0">Range: {{ $spell->range }}</p>
                                <h5>Description:</h5>
                                <p class="card-text mb-0">{{ $spell->description }}</p>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </section>
            @if ($number_of_feats > 0)
                <section class="feats">
                    <h2 class="text-center">Seleziona i feat</h2>
                    <h3 class="text-center">Devi selezionare {{ $number_of_feats }} Feats</h3>
                    <ul class="character-create-feats">
                        @foreach ($feats as $feat)
                            <li>
                                <input {{ $feat->id == $background->feat->id ? "checked disabled" : "" }} type="checkbox" id="feat_{{$feat->id}}" name="feats[]" value="{{ $feat->id }}">
                                <label class="form-label text-capitalize" for="feat_{{ $feat->id }}"><a
                                        href="{{ route('feats.show', $feat) }}">{{ $feat->name }}</a></label>
                                <p class="card-text">{{ $feat->description }}</p>
                            </li>

                        @endforeach
                    </ul>
                    @error('feats')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                </section>
            @endif
            <label class="form-label" for="backstory">Storia del personaggio</label>
            <textarea class="form-control" id="backstory" name="backstory"></textarea>
            <label class="form-label" for="inventory">Inventario</label>
            <textarea class="form-control" id="inventory" name="inventory"
                hidden>{{ $background->equipment . " " . $profession->starting_equipment }}</textarea>
            <textarea class="form-control" id="inventory" name="inventory"
                disabled>{{ $background->equipment . " " . $profession->starting_equipment }}</textarea>
            <label class="form-label" for="image">Immagine</label>
            <input class="form-control" type="file" name="image" id="image">

            <input class="btn btn-primary my-2" type="submit" value="Vai al prossimo step">
        </form>
    </div>
@endsection