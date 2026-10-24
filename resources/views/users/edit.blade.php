@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1>Modifica lo user: {{ $user->name }}</h1>
        <form action="{{ route('users.update', $user) }}" method="POST" class="form-control mb-4 d-flex flex-column">
            @csrf
            @method("PUT")
            <label class="form-label" for="name">Nome</label>
            <input required class="form-control" type="text" name="name" id="name"  value="{{ $user->name }}">
            <label class="form-label" for="name">Role</label>
            <input required class="form-control" type="text" name="role" id="role"  value="{{ $user->role }}">
            <input class="btn btn-primary my-2" type="submit" value="Modifica">
        </form>
    </div>
@endsection