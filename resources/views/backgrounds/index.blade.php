@extends('layouts.app')

@section('content')
<div class="container my-3">
    <a class="btn btn-primary my-2" href="{{ route('backgrounds.create') }}">Aggiungi Background</a>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-2">
        @foreach($backgrounds as $background)
        <div class="col">
            <x-background-card :selfBackground="$background">
                <x-slot:name>{{ $background->name }}</x-slot>
                <x-slot:equipment>{{ $background->description }}</x-slot>
            </x-background-card>
        </div>
        @endforeach
    </div>
</div>
@endsection