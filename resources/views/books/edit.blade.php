@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Editar Libro</h1>

    <form method="POST" action="{{ route('books.update', $book->id) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-sm font-medium">Título</label>
            <input type="text" name="title" id="title" value="{{ $book->title }}" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label for="author" class="block text-sm font-medium">Autor</label>
            <input type="text" name="author" id="author" value="{{ $book->author }}" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label for="genre" class="block text-sm font-medium">Género</label>
            <input type="text" name="genre" id="genre" value="{{ $book->genre }}" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label for="available" class="block text-sm font-medium">Disponibilidad</label>
            <select name="available" id="available" class="w-full border p-2 rounded">
                <option value="1" {{ $book->available ? 'selected' : '' }}>Disponible</option>
                <option value="0" {{ !$book->available ? 'selected' : '' }}>Prestado</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Actualizar Libro
        </button>

        <a href="{{ route('books.index') }}" class="text-gray-600 hover:underline ml-4">Cancelar</a>
    </form>
</div>
@endsection