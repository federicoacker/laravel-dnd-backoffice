@extends('layouts.app')

@section('content')
<div class="container my-3">
    <a class="btn btn-primary my-2" href="{{ route('spells.create') }}">Aggiungi Spell</a>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-2">
        @foreach($spells as $spell)
        <div class="col">
            <x-spell-card :selfSpell="$spell">
                <x-slot:name>{{ $spell->name }}</x-slot>
                <x-slot:level>{{ $spell->level }}</x-slot>
                <x-slot:casting_time>{{ $spell->casting_time }}</x-slot>
                <x-slot:range>{{ $spell->range }}</x-slot>
                <x-slot:components>{{ $spell->components }}</x-slot>
                <x-slot:duration>{{ $spell->duration }}</x-slot>
                <x-slot:description>{{ $spell->description }}</x-slot>
            </x-spell-card>
        </div>
        @endforeach
    </div>
</div>
@endsection