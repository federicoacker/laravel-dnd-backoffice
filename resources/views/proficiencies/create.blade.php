@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1>Aggiungi una nuova proficiency</h1>
        <form action="{{ route('proficiencies.store') }}" method="POST" class="form-control mb-4 d-flex flex-column">
            @csrf
            <label class="form-label" for="name">Nome</label>
            <input required class="form-control" type="text" name="name" id="name">
            <label class="form-label" for="description">Descrizione</label>
            <textarea required class="form-control" name="description" id="description"></textarea>
            <label class="form-label" for="ability_score">Abilità associata:</label>
            <select class="form-select" name="ability_score" id="ability_score">
                <option value="">Nessuna</option>
                <option value="Strength">Strength</option>
                <option value="Dexterity">Dexterity</option>
                <option value="Constitution">Constitution</option>
                <option value="Intellect">Intellect</option>
                <option value="Wisdom">Wisdom</option>
                <option value="Charisma">Charisma</option>
            </select>
            <label class="form-label" for="type">Tipo di proficiency</label>
            <select required class="form-select" name="type" id="type">
                <option value="Skill">Skill</option>
                <option value="Tool">Tool</option>
                <option value="Weapon">Weapon</option>
            </select>
            <input class="btn btn-primary my-2" type="submit" value="Aggiungi">
        </form>
    </div>
@endsection