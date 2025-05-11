@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Listado de Libros</h1>

    <a href="{{ route('books.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
        + Agregar Libro
    </a>

    <table class="min-w-full bg-white border">
        <thead>
            <tr class="bg-gray-200">
                <th class="text-left p-3">Título</th>
                <th class="text-left p-3">Autor</th>
                <th class="text-left p-3">Género</th>
                <th class="text-left p-3">Disponibilidad</th>
                <th class="text-left p-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
            <tr class="border-t hover:bg-gray-100">
                <td class="p-3">{{ $book->title }}</td>
                <td class="p-3">{{ $book->author }}</td>
                <td class="p-3">{{ $book->genre }}</td>
                <td class="p-3">{{ $book->available ? 'Disponible' : 'Prestado' }}</td>
                <td class="p-3 flex gap-2">
                    <a href="{{ route('books.edit', $book->id) }}" class="text-blue-600 hover:underline">Editar</a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este libro?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
