@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1>Modifica la classe: {{ $class->name }}</h1>
        <form action="{{ route('classes.update', $class) }}" method="POST" class="form-control mb-4 d-flex flex-column"
            enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <label class="form-label" for="name">Nome</label>
            <input required class="form-control" type="text" name="name" id="name" value="{{ $class->name }}">

            <label class="form-label" for="description">Descrizione</label>
            <textarea required class="form-control" name="description" id="description">{{ $class->description }}
                    </textarea>

            <label class="form-label" for="primary_ability">Abilità principale:</label>
            <select required class="form-select" name="primary_ability" id="primary_ability">
                <option {{ $class->primary_ability == "Strength" ? "selected" : "" }} value="Strength">Strength</option>
                <option {{ $class->primary_ability == "Dexterity" ? "selected" : "" }} value="Dexterity">Dexterity</option>
                <option {{ $class->primary_ability == "Constitution" ? "selected" : "" }} value="Constitution">Constitution</option>
                <option {{ $class->primary_ability == "Intellect" ? "selected" : "" }} value="Intellect">Intellect</option>
                <option {{ $class->primary_ability == "Wisdom" ? "selected" : "" }} value="Wisdom">Wisdom</option>
                <option {{ $class->primary_ability == "Charisma" ? "selected" : "" }} value="Charisma">Charisma</option>
            </select>

            <label class="form-label" for="hit_points_die">Dado Vita</label>
            <select name="hit_points_die" id="hit_points_die" class="form-select">
                @php
                    $dies = ['1d6', '1d8', '1d10', '1d12'];
                @endphp
                @foreach($dies as $die)
                    <option {{ $class->hit_points_die == $die ? "selected" : "" }} value="{{ $die }}">{{ $die }}</option>
                @endforeach
            </select>

            <label class="form-label" for="hit_points_at_level_1">Punti vita a livello 1:</label>
            <select name="hit_points_at_level_1" id="hit_points_at_level_1" class="form-select">
                @php
                    $hps = ['6 + constitution modifier', '8 + constitution modifier', '10 + constitution modifier', '12 + constitution modifier'];
                @endphp
                @foreach($hps as $hp)
                    <option {{ $class->hit_points_at_level_1 == $hp ? "selected" : "" }} value="{{ $hp }}">{{ $hp }}</option>
                @endforeach
            </select>

            <label class="form-label" for="saving_throws">Tiri salvezza</label>
            <input required class="form-control" type="text" id="saving_throws" name="saving_throws" value="{{ $class->saving_throws }}">

            <label class="form-label" for="armor_training">Competenze Armatura</label>
            <textarea class="form-control" name="armor_training" id="armor_training">{{ $class->armor_training }}</textarea>

            <label class="form-label" for="number_of_skill_proficiencies">Numero di competenze skill selezionabili</label>
            <input required class="form-control" type="number" min="2" max="8" name="number_of_skill_proficiencies"
                id="number_of_skill_proficiencies" value="{{ $class->number_of_skill_proficiencies }}">

            @if($class->number_of_tool_proficiencies)
            <label class="form-label" for="number_of_tool_proficiencies">Numero di competenze skill selezionabili</label>
            <input required class="form-control" type="number" min="2" max="8" name="number_of_tool_proficiencies"
                id="number_of_tool_proficiencies" value="{{ $class->number_of_tool_proficiencies }}">
            @endif

            @if($class->type_of_tool_proficiencies)
            <label class="form-label" for="type_of_tool_proficiencies">Tipo di tool proficiencies selezionabili</label>
            <select name="type_of_tool_proficiencies" id="type_of_tool_proficiencies">
                <option {{ $class->type_of_tool_proficiencies == "Tool" ? "selected" : "" }} value="Tool">Tool</option>
                <option {{ $class->type_of_tool_proficiencies == "Musical Instrument" ? "selected" : "" }} value="Musical Instrument">Musical Instrument</option>
            </select>
            @endif

            <div class="dropdown my-2">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false" data-bs-auto-close="outside">
                    Competenze
                </button>
                <ul class="dropdown-menu px-2" data-bs-autohide="false">
                    @foreach ($proficiencies as $proficiency)
                        <li class="d-flex gap-2">
                            <input class="form-check" type="checkbox" name="proficiencies[]" id="{{ $proficiency->name }}"
                                value="{{ $proficiency->id }}" {{ $class->proficiencies->contains($proficiency->id) ? "checked" : "" }}>
                            <label class="form-label mb-0 text-capitalize" for="{{ $proficiency->name }}">
                                {{ $proficiency->type }}: {{ $proficiency->name }}</label>
                        </li>
                    @endforeach
                </ul>
            </div>

            @error('proficiencies')
                <div style="color: red;">{{ $message }}</div>
            @enderror
            <div class="dropdown my-2">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false" data-bs-auto-close="outside">
                    Feature di Classe
                </button>
                <ul class="dropdown-menu px-2" data-bs-autohide="false">
                    @foreach ($features as $feature)
                        <li class="d-flex gap-2">
                            <input class="form-check" type="checkbox" name="features[]" id="{{ $feature->name }}"
                                value="{{ $feature->id }}" {{ $class->features->contains($feature->id) ? "checked" : "" }}>
                            <label class="form-label mb-0 text-capitalize" for="{{ $feature->name }}">
                                {{ $feature->name }}</label>
                        </li>
                    @endforeach
                </ul>
            </div>
            @error('features')
                <div style="color: red;">{{ $message }}</div>
            @enderror

            <div class="dropdown my-2">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false" data-bs-auto-close="outside">
                    Spells
                </button>
                <ul class="dropdown-menu px-2" data-bs-autohide="false">
                    @foreach ($spells as $spell)
                        <li class="d-flex gap-2">
                            <input class="form-check" type="checkbox" name="spells[]" id="{{ $spell->name }}"
                                value="{{ $spell->id }}" {{ $class->spells->contains($spell->id) ? "checked" : ""}}>
                            <label class="form-label mb-0 text-capitalize" for="{{ $spell->name }}">
                                {{ $spell->name }}</label>
                        </li>
                    @endforeach
                </ul>
            </div>
            @error('spells')
                <div style="color: red;">{{ $message }}</div>
            @enderror

            <label class="form-label" for="starting_equipment">Equipaggiamento iniziale</label>
            <textarea class="form-control" name="starting_equipment" id="starting_equipment">{{ $class->starting_equipment }}</textarea>

            <label class="form-label" for="image">Immagine</label>
            <input class="form-control" type="file" name="image" id="image">
            @if($class->image)
            <img src="{{ asset('storage/'.$class->image) }}" alt="Immagine {{ $class->name }}" class="card-img-top">
            @endif

            <input class="btn btn-primary my-2" type="submit" value="Modifica">
        </form>
    </div>
@endsection