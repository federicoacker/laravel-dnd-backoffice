@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1>Aggiungi una nuova classe</h1>
        <form action="{{ route('classes.store') }}" method="POST" class="form-control mb-4 d-flex flex-column" enctype="multipart/form-data">
            @csrf

            <label class="form-label" for="name">Nome</label>
            <input required class="form-control" type="text" name="name" id="name">

            <label class="form-label" for="description">Descrizione</label>
            <textarea required class="form-control" name="description" id="description"></textarea>

            <label class="form-label" for="primary_ability">Abilità principale:</label>
            <select required class="form-select" name="primary_ability" id="primary_ability">
                <option value="Strength">Strength</option>
                <option value="Dexterity">Dexterity</option>
                <option value="Constitution">Constitution</option>
                <option value="Intellect">Intellect</option>
                <option value="Wisdom">Wisdom</option>
                <option value="Charisma">Charisma</option>
            </select>

            <label class="form-label" for="hit_points_die">Dado Vita</label>
            <select name="hit_points_die" id="hit_points_die" class="form-select">
                @php
                    $dies = ['1d6','1d8','1d10','1d12'];
                @endphp
                @foreach($dies as $die)
                <option value="{{ $die }}">{{ $die }}</option>
                @endforeach
            </select>

            <label class="form-label" for="hit_points_at_level_1">Punti vita a livello 1:</label>
            <select name="hit_points_at_level_1" id="hit_points_at_level_1" class="form-select">
                @php
                    $hps = ['6 + constitution modifier','8 + constitution modifier','10 + constitution modifier','12 + constitution modifier'];
                @endphp
                @foreach($hps as $hp)
                <option value="{{ $hp }}">{{ $hp }}</option>
                @endforeach
            </select>

            <label class="form-label" for="armor_training">Competenze Armatura</label>
            <textarea class="form-control" name="armor_training" id="armor_training"></textarea>

            <label class="form-label" for="number_of_proficiencies">Numero di competenze selezionabili</label>
            <input required class="form-control" type="number" min="2" max="8" name="number_of_proficiencies" id="number_of_proficiencies">

            <div class="dropdown my-2">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false" data-bs-auto-close="outside">
                    Competenze
                </button>
                <ul class="dropdown-menu px-2" data-bs-autohide="false">
                    @foreach ($proficiencies as $proficiency)
                        <li class="d-flex gap-2">
                            <input class="form-check" type="checkbox" name="proficiencies[]" id="{{ $proficiency->name }}"
                                value="{{ $proficiency->id }}">
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
                                value="{{ $feature->id }}">
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
                                value="{{ $spell->id }}">
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
            <textarea class="form-control" name="starting_equipment" id="starting_equipment"></textarea>

            <label class="form-label" for="image">Immagine</label>
            <input class="form-control" type="file" name="image" id="image">

            <input class="btn btn-primary my-2" type="submit" value="Aggiungi">
        </form>
    </div>
@endsection