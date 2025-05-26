@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Listado de Libros</h1>

    <div class="mb-4">
        <a href="{{ route('books.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-blue-700 transition">
            Agregar Libro
        </a>
    </div>

    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Título</th>
                <th class="py-2 px-4 border-b">Autor</th>
                <th class="py-2 px-4 border-b">Género</th>
                <th class="py-2 px-4 border-b">Disponibilidad</th>
                <th class="py-2 px-4 border-b">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td class="py-2 px-4 border-b">{{ $book->title }}</td>
                <td class="py-2 px-4 border-b">{{ $book->author }}</td>
                <td class="py-2 px-4 border-b">{{ $book->genre }}</td>
                <td class="py-2 px-4 border-b">
                    {{ $book->available ? 'Disponible' : 'Prestado' }}
                </td>
                <td class="py-2 px-4 border-b">
                    <a href="{{ route('books.edit', $book) }}" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 transition">Editar</a>
                    <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition" onclick="return confirm('¿Seguro que deseas eliminar este libro?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection