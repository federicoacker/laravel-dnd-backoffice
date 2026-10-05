@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1>Modifica {{ $species->name }}</h1>
        <form action="{{ route('species.update', $species) }}" method="POST" class="form-control mb-4 d-flex flex-column"
            enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <label class="form-label" for="name">Nome</label>
            <input required class="form-control" type="text" name="name" id="name" value="{{ $species->name }}">
            <label class="form-label" for="description">Descrizione</label>
            <textarea required class="form-control" name="description" id="description">{{ $species->description }}</textarea>
            <div class="dropdown my-2">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false" data-bs-auto-close="outside">
                    Feature Razziali
                </button>
                <ul class="dropdown-menu px-2" data-bs-autohide="false">
                    @foreach ($features as $feature)
                        <li class="d-flex gap-2">
                            <input {{ $species->features->contains($feature->id) ? "checked" : "" }} class="form-check" type="checkbox" name="features[]" id="{{ $feature->name }}"
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

            <label class="form-label" for="image">Immagine</label>
            <input class="form-control" type="file" name="image" id="image">
            @if($species->image)
            <img class="jumbo-image-show" src="{{ asset('storage/' . $species->image) }}" alt="Immagine {{ $species->name }}">
            @endif
            <input class="btn btn-primary my-2" type="submit" value="Modifica">
        </form>
    </div>
@endsection