@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1>Modifica la feature: {{ $feature->name }}</h1>
        <form action="{{ route('features.update', $feature) }}" method="POST" class="form-control mb-4 d-flex flex-column">
            @csrf
            @method("PUT")
            <label class="form-label" for="name">Nome</label>
            <input required class="form-control" type="text" name="name" id="name"  value="{{ $feature->name }}">
            <label class="form-label" for="description">Descrizione</label>
            <textarea required class="form-control" name="description" id="description">{{ $feature->description }}</textarea>
            <label class="form-label" for="type">Tipo di Feature</label>
            <select required class="form-select" name="type" id="type">
                <option {{ $feature->type == "Species" ? "selected" : "" }} value="Species">Specie</option>
                <option {{ $feature->type == "Profession" ? "selected" : "" }} value="Profession">Classe</option>
            </select>
            <input class="btn btn-primary my-2" type="submit" value="Modifica">
        </form>
    </div>
@endsection