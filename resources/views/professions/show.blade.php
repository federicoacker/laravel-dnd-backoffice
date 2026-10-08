@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4">

            <h1 class="text-center text-capitalize">{{ $class->name }}</h1>
            <hr>
            <div class="container">
                @if($class->image)
                    <img class="jumbo-image-show" src="{{ asset('storage/' . $class->image) }}" alt="immagine {{$class->name}}">
                    <hr>
                @endif
                <section class="class-privileges d-flex flex-column gap-2">
                    <h5 class="card-subtitle">Abilità Primaria: {{ $class->primary_ability }}</h5>
                    <h5 class="card-subtitle">Dado Vita: {{ $class->hit_points_die }}</h5>
                    <h5 class="card-subtitle">Punti Vita a Livello 1: {{ $class->hit_points_at_level_1 }}</h5>
                    <h5 class="card-subtitle">Competenza Armature: {{ $class->armor_training }}</h5>
                    <h5 class="card-subtitle">Competenze: </h5>
                    <ul class="profession-card-list">
                        <h6 class="card-subtitle mb-2">Scegli {{ $class->number_of_proficiencies }} proficiencies tra:</h6>
                        @php
                            $proficiencies = $class->proficiencies()->get()->toArray();
                            usort($proficiencies, function ($a, $b) {
                                return strcmp($a['type'], $b['type']);
                            });
                        @endphp
                        @foreach($proficiencies as $proficiency)
                            <li><a href="{{ route('proficiencies.show', $proficiency['id']) }}"
                                    class="text-capitalize">{{ $proficiency['type'] }}: {{ $proficiency['name'] }}
                                    ({{ $proficiency['ability_score'] }})</a></li>
                        @endforeach
                    </ul>
                </section>
                <hr>
                <section class="profession-description mb-2">
                    <h5 class="card-subtitle">Descrizione:</h5>
                    <p class="card-text">{{ $class->description }}</p>
                </section>
                <hr>
                <section class="starting-equipment mb-2">
                    <h5 class="card-subtitle">Equipaggiamento iniziale</h5>
                    <p class="card-text">{{ $class->starting_equipment }}</p>
                </section>
                <hr>
                <section class="class-features">
                    <h5 class="card-subtitle">Features di classe:</h5>
                    <ul class="profession-card-list">
                        @foreach($class->features as $feature)
                            <li>
                                <a href="{{ route('features.show', $feature) }}">{{ $feature->name }}</a>
                                <p class="card-text">{{ $feature->description }}</p>
                            </li>
                        @endforeach
                    </ul>
                </section>
                <hr>
                @if(count($class->spells)>0)
                    <section class="spell-list">
                        <h5 class="card-subtitle">Spells:</h5>
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-2">
                            @foreach($class->spells as $spell)
                                <div class="col">
                                    <x-spell-card :selfSpell="$spell">
                                        <x-slot:type>edit</x-slot:type>
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
                    </section>
                    <hr>
                @endif
                
            </div>

            <div class="d-flex justify-content-center gap-2 mt-4">
                <a class="btn btn-warning" href="{{ route("classes.edit", $class) }}">Modifica</a>
                <button type="button" class="btn btn-danger px-1 py-0" data-bs-toggle="modal"
                    data-bs-target="#deleteModal-{{ $class->id }}">
                    Elimina
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal-{{ $class->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Elimina la classe?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Sei sicuro di voler eliminare la Classe: <span class="text-capitalize">
                        {{ $class->name }}
                    </span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <form action="{{ route('classes.destroy', $class) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="submit" class="btn btn-danger" value="Elimina Definitivamente">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection