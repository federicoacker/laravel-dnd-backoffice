@extends('layouts.app')

@section('content')
<div class="container my-3">
    <a class="btn btn-primary my-2" href="{{ route('characters.create') }}">Aggiungi Personaggio</a>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-2">
        @foreach($characters as $character)
        <div class="col">
            <x-character-card :selfCharacter="$character">
            </x-character-card>
        </div>
        @endforeach
    </div>
</div>
@endsection