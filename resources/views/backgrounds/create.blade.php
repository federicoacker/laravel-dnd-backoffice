@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1>Aggiungi un nuovo background</h1>
        <form action="{{ route('backgrounds.store') }}" method="POST" class="form-control mb-4 d-flex flex-column">
            @csrf
            <label class="form-label" for="name">Nome</label>
            <input required class="form-control" type="text" name="name" id="name">
            <label class="form-label" for="description">Descrizione</label>
            <textarea required class="form-control" name="description" id="description"></textarea>
            <div class="dropdown my-2">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false" data-bs-auto-close="outside">
                    Abilità associate
                </button>
                <ul class="dropdown-menu px-2" data-bs-autohide="false">
                    <li class="d-flex gap-2">
                        <input class="form-check" type="checkbox" name="ability_scores[]" id="Strength" value="Strength">
                        <label class="form-label mb-0 text-capitalize" for="Strength">Strength</label>
                    </li>
                    <li class="d-flex gap-2">
                        <input class="form-check" type="checkbox" name="ability_scores[]" id="Dexterity" value="Dexterity">
                        <label class="form-label mb-0 text-capitalize" for="Dexterity">Dexterity</label>
                    </li>
                    <li class="d-flex gap-2">
                        <input class="form-check" type="checkbox" name="ability_scores[]" id="Constitution"
                            value="Constitution">
                        <label class="form-label mb-0 text-capitalize" for="Constitution">Constitution</label>
                    </li>
                    <li class="d-flex gap-2">
                        <input class="form-check" type="checkbox" name="ability_scores[]" id="Intellect" value="Intellect">
                        <label class="form-label mb-0 text-capitalize" for="Intellect">Intellect</label>
                    </li>
                    <li class="d-flex gap-2">
                        <input class="form-check" type="checkbox" name="ability_scores[]" id="Wisdom" value="Wisdom">
                        <label class="form-label mb-0 text-capitalize" for="Wisdom">Wisdom</label>
                    </li>
                    <li class="d-flex gap-2">
                        <input class="form-check" type="checkbox" name="ability_scores[]" id="Charisma" value="Charisma">
                        <label class="form-label mb-0 text-capitalize" for="Charisma">Charisma</label>
                    </li>
                </ul>
            </div>
            @error('ability_scores')
                <div style="color: red;">{{ $message }}</div>
            @enderror
            <div class="dropdown my-2">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false" data-bs-auto-close="outside">
                    Proficiencies
                </button>
                <ul class="dropdown-menu px-2">
                    @foreach ($proficiencies as $proficiency)
                        <li class="d-flex gap-2">
                            <input class="form-check" type="checkbox" name="proficiencies[]" id="{{$proficiency->name}}"
                                value="{{ $proficiency->id }}">
                            <label class="form-label mb-0 text-capitalize"
                                for="{{ $proficiency->name }}">{{$proficiency->name}}</label>
                        </li>
                    @endforeach
                </ul>
            </div>
            <label class="form-label" for="equipment">Equipaggiamento</label>
            <textarea required class="form-control" name="equipment" id="equipment"></textarea>
            <label class="form-label" for="feat_id">Feat</label>
            <select class="form-select" id="feat_id" name="feat_id">
                @foreach ($feats as $feat)
                    <option value="{{ $feat->id }}" class="text-capitalize">{{ $feat->name }}</option>
                @endforeach
            </select>
            <input class="btn btn-primary my-2" type="submit" value="Aggiungi">
        </form>
    </div>
@endsection