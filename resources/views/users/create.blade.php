@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1>Crea un nuovo user</h1>
        <form action="{{ route('users.store') }}" method="POST" class="form-control mb-4 d-flex flex-column">
            @csrf
            <label class="form-label" for="name">Nome</label>
            <input required class="form-control" type="text" name="name" id="name">
            <label class="form-label" for="name">Role</label>
            <input required class="form-control" type="text" name="role" id="role">
            <label class="form-label" for="email">Email</label>
            <input required class="form-control" type="text" name="email" id="email">
            <label class="form-label" for="password">Password</label>
            <input required class="form-control" type="password" name="password" id="password">
            <label class="form-label" for="password_confirmation">Confirm Password</label>
            <input required class="form-control" type="password" name="password_confirmation" id="password_confirmation">

            <input class="btn btn-primary my-2" type="submit" value="Modifica">
        </form>
    </div>
@endsection