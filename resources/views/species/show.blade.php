@extends('layouts.app')

@section('content')
    <div class="my-4">

        <h1 class="text-center text-capitalize">{{ $species->name }}</h1>
        <div class="container">
            <div class="card-text">
                {{ $species->description }}
            </div>
            <hr>
            @if($species->image)
                <img class="jumbo-image-show" src="{{ asset('storage/' . $species->image) }}" alt="immagine specie">
                <hr>
            @endif
            <div class="card-title">
                <h2>Feature Razziali</h2>
                <ul class="species-features">
                    @foreach ($species->features as $feature)
                        <li><a class="feature-title" href={{ route('features.show', $feature)}}>{{ $feature->name }}</a></li>
                        <p class="feature-description">
                            {{ $feature->description }}
                        </p>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="d-flex justify-content-center gap-2 mt-4">
            <a class="btn btn-warning" href="{{ route("species.edit", $species) }}">Modifica</a>
            <button type="button" class="btn btn-danger px-1 py-0" data-bs-toggle="modal"
                data-bs-target="#deleteModal-{{ $species->id }}">
                Elimina
            </button>
        </div>
    </div>
    </div>

    <div class="modal fade" id="deleteModal-{{ $species->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Elimina la specie?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Sei sicuro di voler eliminare la specie: <span class="text-capitalize">
                        {{ $species->name }}
                    </span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <form action="{{ route('species.destroy', $species) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="submit" class="btn btn-danger" value="Elimina Definitivamente">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection