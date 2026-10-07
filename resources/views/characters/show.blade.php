@php
    $proficiency_bonus = 0;

    if ($character->level <= 4) {
        $proficiency_bonus = 2;
    } elseif ($character->level > 4 && $character->level <= 8) {
        $proficiency_bonus = 3;
    } elseif ($character->level > 8 && $character->level <= 12) {
        $proficiency_bonus = 4;
    } elseif ($character->level > 12 && $character->level <= 16) {
        $proficiency_bonus = 5;
    } else {
        $proficiency_bonus = 6;
    }

    $strength_mod = $character->strength >= 10 ? "+" . floor(($character->strength - 10) / 2) : "-" . ceil((10 - $character->strength) / 2);
    $dexterity_mod = $character->dexterity >= 10 ? "+" . floor(($character->dexterity - 10) / 2) : "-" . ceil((10 - $character->dexterity) / 2);
    $constitution_mod = $character->constitution >= 10 ? "+" . floor(($character->constitution - 10) / 2) : "-" . ceil((10 - $character->constitution) / 2);
    $intellect_mod = $character->intellect >= 10 ? "+" . floor(($character->intellect - 10) / 2) : "-" . ceil((10 - $character->intellect) / 2);
    $wisdom_mod = $character->wisdom >= 10 ? "+" . floor(($character->wisdom - 10) / 2) : "-" . ceil((10 - $character->wisdom) / 2);
    $charisma_mod = $character->charisma >= 10 ? "+" . floor(($character->charisma - 10) / 2) : "-" . ceil((10 - $character->charisma) / 2);

    $matching_scores_to_mods = [
        "Strength" => $strength_mod,
        "Dexterity" => $dexterity_mod,
        "Constitution" => $constitution_mod,
        "Intellect" => $intellect_mod,
        "Wisdom" => $wisdom_mod,
        "Charisma" => $charisma_mod
    ];


@endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4">
            <h1 class="text-center text-capitalize">{{ $character->name }}</h1>
            <hr>
            <div class="container">
                <section class="row row-cols-1 row-cols-xl-2 header-information">
                    <div class="col d-flex align-items-center justify-content-center">
                        @if($character->image)
                            <img src="{{ asset('storage/'.$character->image) }}" alt="Immagine {{ $character->name }}" class="character-image">
                        @else
                            <img src="{{ asset('storage/characters/placeholder.svg') }}" alt="Immagine Placeholder"
                                class="character-image">
                        @endif
                    </div>
                    <section class="col ability-scores">
                        <div class="row row-cols-3 row-cols-xl-6">
                            <div class="col d-flex flex-column justify-content-center align-content-center ability-score">
                                <h5 class="text-center">Strength</h5>
                                <h5 class="text-center">{{ $character->strength }}</h5>
                                <h6 class="text-center">{{ $strength_mod }}</h6>
                            </div>
                            <div class="col d-flex flex-column justify-content-center align-content-center ability-score">
                                <h5 class="text-center">Dexterity</h5>
                                <h5 class="text-center">{{ $character->dexterity }}</h5>
                                <h6 class="text-center">{{ $dexterity_mod }}</h6>
                            </div>
                            <div class="col d-flex flex-column justify-content-center align-content-center ability-score">
                                <h5 class="text-center">Constitution</h5>
                                <h5 class="text-center">{{ $character->constitution }}</h5>
                                <h6 class="text-center">{{ $constitution_mod }}</h6>
                            </div>
                            <div class="col d-flex flex-column justify-content-center align-content-center ability-score">
                                <h5 class="text-center">Intellect</h5>
                                <h5 class="text-center">{{ $character->intellect }}</h5>
                                <h6 class="text-center">{{ $intellect_mod }}</h6>
                            </div>
                            <div class="col d-flex flex-column justify-content-center align-content-center ability-score">
                                <h5 class="text-center">Wisdom</h5>
                                <h5 class="text-center">{{ $character->wisdom }}</h5>
                                <h6 class="text-center">{{ $wisdom_mod }}</h6>
                            </div>
                            <div class="col d-flex flex-column justify-content-center align-content-center ability-score">
                                <h5 class="text-center">Charisma</h5>
                                <h5 class="text-center">{{ $character->charisma }}</h5>
                                <h6 class="text-center">{{ $charisma_mod }}</h6>
                            </div>
                        </div>
                    </section>
                </section>
                <div class="row row-cols-2 row-cols-lg-4">
                    <div class="col profession">
                        <h5 class="text-center">Classe:</h5>
                        <h5 class="text-center text-capitalize"><a
                                href="{{ route('classes.show', $character->profession) }}">{{ $character->profession->name }}</a>
                        </h5>
                    </div>
                    <div class="col level">
                        <h5 class="text-center">Livello:</h5>
                        <h5 class="text-center text-capitalize">{{ $character->level }}</h5>
                    </div>
                    <div class="col proficiency-bonus">
                        <h5 class="text-center text-nowrap">Proficiency bonus:</h5>
                        <h5 class="text-center">+{{ $proficiency_bonus }}</h5>
                    </div>
                    <div class=" col background">
                        <h5 class="text-center">Background:</h5>
                        <h5 class="text-center text-capitalize"><a
                                href="{{ route('backgrounds.show', $character->background) }}">{{$character->background->name}}</a>
                        </h5>
                    </div>
                </div>
                <hr>
                <section class="character-proficiencies">
                    <div class="row row-cols-1 row-cols-lg-3 my-4">
                        <div class="col">
                            <h4>Skills:</h4>
                            <div class="d-flex flex-column">
                                @foreach ($skill_proficiencies as $skill_proficiency)
                                    <p
                                        class="mb-0 text-capitalize {{ $character->proficiencies->contains($skill_proficiency->id) ? "proficient" : "not-proficient" }}">
                                        <a href="{{ route('proficiencies.show', $skill_proficiency) }}">
                                            {{ $skill_proficiency->name }} ({{ $skill_proficiency->ability_score }})
                                            {{ $character->proficiencies->contains($skill_proficiency->id) ? "+" . $matching_scores_to_mods[$skill_proficiency->ability_score] + $proficiency_bonus : $matching_scores_to_mods[$skill_proficiency->ability_score] }}
                                        </a>
                                    </p>
                                @endforeach
                            </div>
                            <hr>
                            <h4>Tools:</h4>
                            <div class="d-flex flex-column">
                                @foreach ($tool_proficiencies as $tool_proficiency)
                                    <p
                                        class="mb-0 text-capitalize {{ $character->proficiencies->contains($tool_proficiency->id) ? "proficient" : "not-proficient" }}">
                                        <a href="{{ route('proficiencies.show', $tool_proficiency) }}">
                                            {{ $tool_proficiency->name }} ({{ $tool_proficiency->ability_score }})
                                            {{ $character->proficiencies->contains($tool_proficiency->id) ? "+" . $matching_scores_to_mods[$tool_proficiency->ability_score] + $proficiency_bonus : $matching_scores_to_mods[$tool_proficiency->ability_score] }}
                                        </a>
                                    </p>
                                @endforeach
                            </div>
                            <hr>
                            <h4>Weapons:</h4>
                            @foreach ($character->proficiencies()->where('type', 'LIKE', 'Weapon')->get() as $weapon_proficiency)
                                <p class="mb-0 text-capitalize"><a
                                        href="{{ route('proficiencies.show', $weapon_proficiency) }}">{{ $weapon_proficiency->name }}</a>
                                </p>
                            @endforeach
                            <hr>
                        </div>
                        <div class="col">
                            <h4>Equipaggiamento:</h4>
                            <p class="mb-0">{{ $character->inventory }}</p>
                            <hr>
                        </div>
                        <div class="col">
                            <h4>Features:</h4>
                            <section class="class-features mb-2">
                                <h5>Di Classe:</h5>
                                @foreach ($character->profession->features as $class_feature)
                                    <h5 class="mb-0 text-capitalize"><a
                                            href="{{ route('features.show', $class_feature) }}">{{ $class_feature->name }}</a>
                                    </h5>
                                    <p class="mb-0">{{ $class_feature->description }}</p>
                                @endforeach
                            </section>
                            <section class="species-feature mb-2">
                                <h5>Razziali:</h5>
                                @foreach ($character->species->features as $species_feature)
                                    <h5 class="mb-0 text-capitalize"><a
                                            href="{{ route('features.show', $species_feature) }}">{{ $species_feature->name }}</a>
                                    </h5>
                                    <p class="mb-0">{{ $species_feature->description }}</p>
                                @endforeach
                            </section>
                        </div>
                    </div>
                </section>
                @if(count($character->feats) > 0)
                    <hr>
                    <section class="feats">
                        <h4 class="text-center">Feats:</h4>
                        @foreach($character->feats as $feat)
                            <h5 class="mb-0 text-capitalize"><a href="{{ route('feats.show', $feat) }}">{{ $feat->name }}</a></h5>
                            <p class="mb-0">{{ $feat->description }}</p>
                        @endforeach
                    </section>
                @endif
                <hr>
                @if($character->backstory)
                    <section class="backstory">
                        <h5 class="card-subtitle text-center mb-2"> Storia del Personaggio:</h5>
                        <p class="card-text"> {{ $character->backstory }}</p>
                    </section>
                    <hr>
                @endif
                @if (count($character->profession->spells) > 0)
                    <section class="spells">
                        <h4 class="text-center">Spells:</h4>
                        <div class="container my-3">
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-2">
                                @foreach($character->profession->spells()->orderBy('level')->get() as $spell)
                                    <div class="col">
                                        <x-spell-card :selfSpell="$spell">
                                            <x-slot:type>show</x-slot:type>
                                            <x-slot:name>{{ $spell->name }}</x-slot>
                                            <x-slot:level>{{ $spell->level }}</x-slot>
                                            <x-slot:casting_time>{{ $spell->casting_time }}</x-slot>
                                            <x-slot:range>{{ $spell->range }}</x-slot>
                                            <x-slot:components>{{ $spell->components }}</x-slot>
                                            <x-slot:duration>{{ $spell->duration }}</x-slot>
                                            <x-slot:description>{{ $spell->description }}</x-slot>
                                        </x-spell-card>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                    <hr>
                @endif

            </div>

            <div class="d-flex justify-content-center gap-2 mt-4">
                <a class="btn btn-warning" href="{{ route("characters.edit", $character) }}">Modifica</a>
                <button type="button" class="btn btn-danger px-1 py-0" data-bs-toggle="modal"
                    data-bs-target="#deleteModal-{{ explode(" ", $character->name)[0] }}">
                    Elimina
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal-{{ explode(" ", $character->name)[0] }}" tabindex="-1"
        aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Elimina il personaggio??</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Sei sicuro di voler eliminare il personaggio: <span class="text-capitalize">
                        {{ $character->name }}
                    </span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <form action="{{ route('characters.destroy', $character) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="submit" class="btn btn-danger" value="Elimina Definitivamente">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection