@extends('layouts.app')

@section('content')
    <h1>Lista de Préstamos</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Libro</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Devolución</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loans as $loan)
                <tr>
                    <td>{{ $loan->user->name }}</td>
                    <td>{{ $loan->book->title }}</td>
                    <td>{{ $loan->start_date }}</td>
                    <td>{{ $loan->return_date }}</td>
                    <td>
                        <form action="{{ route('loans.destroy', $loan) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('loans.create') }}" class="btn btn-primary">Registrar Préstamo</a>
@endsection
