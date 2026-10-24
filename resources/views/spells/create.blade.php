@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1>Aggiungi una nuova Spell</h1>
        <form action="{{ route('spells.store') }}" method="POST" class="form-control mb-4 d-flex flex-column">
            @csrf
            <label for="name" class="form-label">Nome</label>
            <input required class="form-control" name="name" id="name" type="text">
            <label for="level" class="form-label">Livello</label>
            <input required class="form-control" name="level" id="level" type="number" min="0" max="9">
            <label for="casting_time" class="form-label">Tempo di Cast</label>
            <select class="form-select" required name="casting_time" id="casting_time">
                <option value="action">Action</option>
                <option value="bonus action">Bonus action</option>
                <option value="reaction">Reaction</option>
                <option value="1 minute">1 minute</option>
                <option value="10 minutes">10 minutes</option>
            </select>
            <label for="range" class="form-label">Range</label>
            <select class="form-select" required name="range" id="range">
                <option value="self">Self</option>
                <option value="touch">Touch</option>
                <option value="sight">Sight</option>
                <option value="5 feet">5 feet</option>
                <option value="10 feet">10 feet</option>
                <option value="30 feet">30 feet</option>
                <option value="60 feet">60 feet</option>
                <option value="90 feet">90 feet</option>
                <option value="120 feet">120 feet</option>
                <option value="150 feet">150 feet</option>
                <option value="300 feet">300 feet</option>
                <option value="500 feet">500 feet</option>
                <option value="1000 feet">1000 feet</option>
            </select>
            <label class="form-label">Componenti</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="components[]" id="componentV" value="V">
                <label class="form-check-label" for="componentV">
                    Verbal
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="components[]" id="componentS" value="S">
                <label class="form-check-label" for="componentS">
                    Somatic
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="components[]" id="componentM" value="M">
                <label class="form-check-label" for="componentM">
                    Material
                </label>
            </div>
            <label for="duration" class="form-label">Durata</label>
            <input required class="form-control" name="duration" id="duration" type="text">
            <label for="description" class="form-label">Descrizione</label>
            <textarea required class="form-control" name="description" id="description"></textarea> 
            <input class="btn btn-primary my-2" type="submit" value="Aggiungi">
        </form>
    </div>
@endsection