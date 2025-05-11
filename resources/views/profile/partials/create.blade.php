@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Agregar Nuevo Libro</h1>

    <form method="POST" action="{{ route('books.store') }}" class="space-y-4">
        @csrf

        <div>
            <label for="title" class="block text-sm font-medium">Título</label>
            <input type="text" name="title" id="title" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label for="author" class="block text-sm font-medium">Autor</label>
            <input type="text" name="author" id="author" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label for="genre" class="block text-sm font-medium">Género</label>
            <input type="text" name="genre" id="genre" class="w-full border p-2 rounded" required>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Guardar Libro
        </button>

        <a href="{{ route('books.index') }}" class="text-gray-600 hover:underline ml-4">Cancelar</a>
    </form>
</div>
@endsection
