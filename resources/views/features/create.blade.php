@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1>Aggiungi una nuova feature</h1>
        <form action="{{ route('features.store') }}" method="POST" class="form-control mb-4 d-flex flex-column">
            @csrf
            <label class="form-label" for="name">Nome</label>
            <input required class="form-control" type="text" name="name" id="name">
            <label class="form-label" for="description">Descrizione</label>
            <textarea required class="form-control" name="description" id="description"></textarea>
            <label class="form-label" for="type">Tipo di Feature</label>
            <select required class="form-select" name="type" id="type">
                <option value="Species">Specie</option>
                <option value="Profession">Classe</option>
            </select>
            <input class="btn btn-primary my-2" type="submit" value="Aggiungi">
        </form>
    </div>
@endsection