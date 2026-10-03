@extends('layouts.app')

@section('content')
<div class="container my-3">
    <a class="btn btn-primary my-2" href="{{ route('species.create') }}">Aggiungi spell</a>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-2">
        @foreach($species as $specie)
        <div class="col">
            <x-species-card :selfSpecies="$specie">
                <x-slot:name>{{ $specie->name }}</x-slot>
            </x-species-card>
        </div>
        @endforeach
    </div>
</div>
@endsection