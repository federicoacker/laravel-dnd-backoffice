@extends('layouts.app')

@section('content')
<div class="container my-3">
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        @foreach($spells as $spell)
        <x-spell-card :selfSpell="$spell">
            <x-slot:name>{{ $spell->name }}</x-slot>
            <x-slot:level>{{ $spell->level }}</x-slot>
            <x-slot:casting_time>{{ $spell->casting_time }}</x-slot>
            <x-slot:range>{{ $spell->range }}</x-slot>
            <x-slot:components>{{ $spell->components }}</x-slot>
            <x-slot:duration>{{ $spell->duration }}</x-slot>
            <x-slot:description>{{ $spell->description }}</x-slot>
        </x-spell-card>
        @endforeach
    </div>
</div>
@endsection