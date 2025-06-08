@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-black">Listado de Libros</h1>

    <div class="mb-4">
        <a href="{{ route('books.create') }}" 
           class="bg-blue-200 text-black font-semibold px-5 py-2 rounded shadow hover:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
            Agregar Libro
        </a>
    </div>

    <table class="min-w-full bg-white border text-black">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Título</th>
                <th class="py-2 px-4 border-b">Autor</th>
                <th class="py-2 px-4 border-b">Género</th>
                <th class="py-2 px-4 border-b">Disponible</th>
                <th class="py-2 px-4 border-b">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr class="hover:bg-gray-100 transition">
                <td class="py-2 px-4 border-b">{{ $book->title }}</td>
                <td class="py-2 px-4 border-b">{{ $book->author }}</td>
                <td class="py-2 px-4 border-b">{{ $book->genre ? $book->genre->name : '-' }}</td>
                <td class="py-2 px-4 border-b">
                    <span class="inline-block px-2 py-1 text-xs rounded 
                        {{ $book->available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $book->available ? 'Sí' : 'No' }}
                    </span>
                </td>
                <td class="py-2 px-4 border-b flex gap-2">
                    <a href="{{ route('books.edit', $book) }}" 
                       class="bg-yellow-200 text-black font-semibold px-3 py-1 rounded shadow hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition"
                       title="Editar">
                        Editar
                    </a>
                    <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este libro?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-200 text-black font-semibold px-3 py-1 rounded shadow hover:bg-red-300 focus:outline-none focus:ring-2 focus:ring-red-400 transition"
                                title="Eliminar">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection