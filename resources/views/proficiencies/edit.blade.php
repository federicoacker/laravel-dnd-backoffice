@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1>Modifica la proficiency: {{ $proficiency->name }}</h1>
        <form action="{{ route('proficiencies.update', $proficiency) }}" method="POST" class="form-control mb-4 d-flex flex-column">
            @csrf
            @method("PUT")
            <label class="form-label" for="name">Nome</label>
            <input required class="form-control" type="text" name="name" id="name"  value="{{ $proficiency->name }}">
            <label class="form-label" for="description">Descrizione</label>
            <textarea required class="form-control" name="description" id="description">{{ $proficiency->description }}</textarea>
            <label class="form-label" for="ability_score">Abilità associata:</label>
            <select class="form-select" name="ability_score" id="ability_score">
                <option {{ !$proficiency->ability_score ? "selected" : "" }} value="">Nessuna</option>
                <option {{ $proficiency->ability_score == "Strength" ? "selected" : "" }} value="Strength">Strength</option>
                <option {{ $proficiency->ability_score == "Dexterity" ? "selected" : "" }} value="Dexterity">Dexterity</option>
                <option {{ $proficiency->ability_score == "Constitution" ? "selected" : "" }} value="Constitution">Constitution</option>
                <option {{ $proficiency->ability_score == "Intellect" ? "selected" : "" }} value="Intellect">Intellect</option>
                <option {{ $proficiency->ability_score == "Wisdom" ? "selected" : "" }} value="Wisdom">Wisdom</option>
                <option {{ $proficiency->ability_score == "Charisma" ? "selected" : "" }} value="Charisma">Charisma</option>
            </select>
            <label class="form-label" for="type">Tipo di Proficiency</label>
            <select required class="form-select" name="type" id="type">
                <option {{ $proficiency->type == "Skill" ? "selected" : "" }} value="Skill">Skill</option>
                <option {{ $proficiency->type == "Tool" ? "selected" : "" }} value="Tool">Tool</option>
                <option {{ $proficiency->type == "Weapon" ? "selected" : "" }} value="Weapon">Weapon</option>
            </select>
            <input class="btn btn-primary my-2" type="submit" value="Modifica">
        </form>
    </div>
@endsection