@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Dashboard</h2>

    <h4>Usuarios</h4>
    <ul class="list-group mb-4">
        @foreach($users as $user)
            <li class="list-group-item">{{ $user->name }} ({{ $user->email }})</li>
        @endforeach
    </ul>

    <h4>Libros</h4>
    <ul class="list-group mb-4">
        @foreach($books as $book)
            <li class="list-group-item">{{ $book->title }} - {{ $book->author }}</li>
        @endforeach
    </ul>

    <h4>Préstamos</h4>
    <ul class="list-group">
        @foreach($loans as $loan)
            <li class="list-group-item">
                {{ $loan->user->name ?? 'Usuario eliminado' }} prestó "{{ $loan->book->title ?? 'Libro eliminado' }}"
                desde {{ $loan->start_date }} hasta {{ $loan->return_date }}
                @if($loan->returned_at)
                    <span class="badge bg-success">Devuelto</span>
                @else
                    <span class="badge bg-warning text-dark">Pendiente</span>
                @endif
            </li>
        @endforeach
    </ul>
</div>
@endsection