@extends('layouts.app')

@section('content')
<div class="container my-3">
    <a class="btn btn-primary my-2" href="{{ route('classes.create') }}">Aggiungi Classe</a>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-2">
        @foreach($professions as $profession)
        <div class="col">
            <x-profession-card :selfProfession="$profession">
            </x-profession-card>
        </div>
        @endforeach
    </div>
</div>
@endsection