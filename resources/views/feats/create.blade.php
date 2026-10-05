@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1>Aggiungi un nuovo feat</h1>
        <form action="{{ route('feats.store') }}" method="POST" class="form-control mb-4 d-flex flex-column">
            @csrf
            <label class="form-label" for="name">Nome</label>
            <input required class="form-control" type="text" name="name" id="name">
            <label class="form-label" for="description">Descrizione</label>
            <textarea required class="form-control" name="description" id="description"></textarea>
            <input class="btn btn-primary my-2" type="submit" value="Aggiungi">
        </form>
    </div>
@endsection