@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1>Modifica la spell: <span class="text-capitalize">{{ $spell->name }}</span></h1>
        <form action="{{ route('spells.update', $spell) }}" method="POST" class="form-control mb-4 d-flex flex-column">
            @csrf
            @method("PUT")
            <label for="name" class="form-label">Nome</label>
            <input required class="form-control" name="name" id="name" type="text" value="{{ $spell->name }}">
            <label for="level" class="form-label">Livello</label>
            <input required class="form-control" name="level" id="level" type="number" min="0" max="9" value="{{ $spell->level }}">
            <label for="casting_time" class="form-label">Tempo di Cast</label>
            <select class="form-select" required name="casting_time" id="casting_time">
                <option {{ $spell->casting_time == "action" ? "selected" : "" }} value="action">Action</option>
                <option {{ $spell->casting_time == "bonus action" ? "selected" : "" }} value="bonus action">Bonus action</option>
                <option {{ $spell->casting_time == "reaction" ? "selected" : "" }} value="reaction">Reaction</option>
                <option {{ $spell->casting_time == "1 minute" ? "selected" : "" }} value="1 minute">1 minute</option>
                <option {{ $spell->casting_time == "10 minutes" ? "selected" : "" }} value="10 minutes">10 minutes</option>
            </select>
            <label for="range" class="form-label">Range</label>
            <select class="form-select" required name="range" id="range">
                <option {{ $spell->range == "self" ? "selected" : "" }} value="self">Self</option>
                <option {{ $spell->range == "touch" ? "selected" : "" }} value="touch">Touch</option>
                <option {{ $spell->range == "sight" ? "selected" : "" }} value="sight">Sight</option>
                <option {{ $spell->range == "5 feet" ? "selected" : "" }} value="5 feet">5 feet</option>
                <option {{ $spell->range == "10 feet" ? "selected" : "" }} value="10 feet">10 feet</option>
                <option {{ $spell->range == "30 feet" ? "selected" : "" }} value="30 feet">30 feet</option>
                <option {{ $spell->range == "60 feet" ? "selected" : "" }} value="60 feet">60 feet</option>
                <option {{ $spell->range == "90 feet" ? "selected" : "" }} value="90 feet">90 feet</option>
                <option {{ $spell->range == "120 feet" ? "selected" : "" }} value="120 feet">120 feet</option>
                <option {{ $spell->range == "150 feet" ? "selected" : "" }} value="150 feet">150 feet</option>
                <option {{ $spell->range == "300 feet" ? "selected" : "" }} value="300 feet">300 feet</option>
                <option {{ $spell->range == "500 feet" ? "selected" : "" }} value="500 feet">500 feet</option>
                <option {{ $spell->range == "1000 feet" ? "selected" : "" }} value="1000 feet">1000 feet</option>
            </select>
            <label class="form-label">Componenti</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="components[]" id="componentV" value="V" {{ str_contains($spell->components, "V") ? "checked" : "" }}>
                <label class="form-check-label" for="componentV">
                    Verbal
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="components[]" id="componentS" value="S" {{ str_contains($spell->components, "S") ? "checked" : "" }}>
                <label class="form-check-label" for="componentS">
                    Somatic
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="components[]" id="componentM" value="M" {{ str_contains($spell->components, "M") ? "checked" : "" }}>
                <label class="form-check-label" for="componentM">
                    Material
                </label>
            </div>
            <label for="duration" class="form-label">Durata</label>
            <input required class="form-control" name="duration" id="duration" type="text" value="{{ $spell->duration }}">
            <label for="description" class="form-label">Descrizione</label>
            <textarea required class="form-control" name="description" id="description">{{ $spell->description }}</textarea> 
            <input class="btn btn-primary my-2" type="submit" value="Modifica">
        </form>
    </div>
@endsection