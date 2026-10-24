@extends('layouts.app')

@section('content')
<div class="container my-3">
    <a class="btn btn-primary my-2" href="{{ route('features.create') }}">Aggiungi Feature</a>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-2">
        @foreach($features as $feature)
        <div class="col">
            <x-feature-card :selfFeature="$feature">
                <x-slot:name>{{ $feature->name }}</x-slot>
                <x-slot:description>{{ $feature->description }}</x-slot>
                <x-slot:type>{{ $feature->type }}</x-slot>
            </x-feature-card>
        </div>
        @endforeach
    </div>
</div>
@endsection