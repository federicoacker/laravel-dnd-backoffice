@extends('layouts.app')

@section('content')
<div class="container my-3">
    <a class="btn btn-primary my-2" href="{{ route('feats.create') }}">Aggiungi Feat</a>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-2">
        @foreach($feats as $feat)
        <div class="col">
            <x-feat-card :selfFeat="$feat">
                <x-slot:name>{{ $feat->name }}</x-slot>
                <x-slot:description>{{ $feat->description }}</x-slot>
            </x-feat-card>
        </div>
        @endforeach
    </div>
</div>
@endsection