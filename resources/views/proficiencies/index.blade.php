@extends('layouts.app')

@section('content')
<div class="container my-3">
    <a class="btn btn-primary my-2" href="{{ route('proficiencies.create') }}">Aggiungi Proficiency</a>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-2">
        @foreach($proficiencies as $proficiency)
        <div class="col">
            <x-proficiency-card :selfProficiency="$proficiency">
                <x-slot:name>{{ $proficiency->name }}</x-slot>
                <x-slot:description>{{ $proficiency->description }}</x-slot>
                <x-slot:type>{{ $proficiency->type }}</x-slot>
            </x-proficiency-card>
        </div>
        @endforeach
    </div>
</div>
@endsection