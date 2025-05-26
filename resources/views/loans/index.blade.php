@extends('layouts.app')

@section('content')
    <h1>Lista de Préstamos</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('loans.create') }}" class="btn btn-primary mb-3">Registrar Préstamo</a>
    <a href="{{ route('books.create') }}" class="btn btn-success mb-3 ms-2">Agregar Libro</a>
    {{-- Si usas Tailwind, puedes cambiar las clases por: bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition --}}

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
                        <form action="{{ route('loans.destroy', $loan) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                        @if(!$loan->returned_at)
                            <form action="{{ route('loans.return', $loan) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success">Devolver</button>
                            </form>
                        @else
                            <span class="text-secondary">Devuelto</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
