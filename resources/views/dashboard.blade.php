@extends('layouts.app')

@section('content')
    <div class="container my-4">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Dashboard') }}
        </h2>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('User Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a class="btn btn-primary my-2" href="{{ route('users.create') }}">Add User</a>
                        <table class="w-100">
                            <thead class="text-center">
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td class="d-flex flex-wrap justify-content-center gap-2 align-items-stretch">
                                            <a href="{{ route('users.edit', $user) }}" class="btn btn-primary"><i
                                                    class="bi bi-pencil-square"></i></a>
                                            <button type="button" class="btn btn-danger px-1 py-0" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal-{{ $user->id }}">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>

                                            <div class="modal fade" id="deleteModal-{{ $user->id }}" tabindex="-1"
                                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="deleteModalLabel">Elimina l'utente?
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Sei sicuro di voler eliminare l'utente: <span
                                                                class="text-capitalize">
                                                                {{ $user->name }}
                                                            </span>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Annulla</button>
                                                            <form action="{{ route('users.destroy', $user) }}" method="POST">
                                                                @csrf
                                                                @method("DELETE")
                                                                <input type="submit" class="btn btn-danger"
                                                                    value="Elimina Definitivamente">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection