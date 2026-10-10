@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4">

            <h1 class="text-center text-capitalize">{{ $feat->name }}</h1>
            <hr>
            <div class="container">
                <p class="card-text">
                    {!! nl2br($feat->description)  !!}
                </p>
            </div>

            <div class="d-flex justify-content-center gap-2 mt-4">
                <a class="btn btn-warning" href="{{ route("feats.edit", $feat) }}">Modifica</a>
                <button type="button" class="btn btn-danger px-1 py-0" data-bs-toggle="modal"
                    data-bs-target="#deleteModal-{{ $feat->id }}">
                    Elimina
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal-{{ $feat->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Elimina il feat?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Sei sicuro di voler eliminare il Feat: <span class="text-capitalize">
                        {{ $feat->name }}
                    </span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <form action="{{ route('feats.destroy', $feat) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="submit" class="btn btn-danger" value="Elimina Definitivamente">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection