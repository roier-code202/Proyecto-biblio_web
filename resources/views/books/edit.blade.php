@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-2xl">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Editar Libro: {{ $book->title }}</h1>
        <a href="{{ route('books.index') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Volver al listado</a>
    </div>

    <form method="POST" action="{{ route('books.update', $book->id) }}" class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        @csrf
        @method('PUT')

        <!-- Campo Título -->
        <div class="mb-5">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Título *</label>
            <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500 @error('title') border-red-500 @enderror" required>
            @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo Autor -->
        <div class="mb-5">
            <label for="author" class="block text-sm font-medium text-gray-700 mb-1">Autor *</label>
            <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500 @error('author') border-red-500 @enderror" required>
            @error('author')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo Género -->
        <div class="mb-3">
            <label for="genre_id" class="form-label">Género</label>
            <select name="genre_id" id="genre_id" class="form-select" required>
                <option value="">Seleccione un género</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ old('genre_id', $book->genre_id) == $genre->id ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Campo Disponibilidad -->
        <div class="mb-6">
            <label for="available" class="block text-sm font-medium text-gray-700 mb-1">Estado *</label>
            <select name="available" id="available" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500 @error('available') border-red-500 @enderror" required>
                <option value="1" {{ old('available', $book->available) == 1 ? 'selected' : '' }}>Disponible</option>
                <option value="0" {{ old('available', $book->available) == 0 ? 'selected' : '' }}>Prestado</option>
            </select>
            @error('available')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botones -->
        <div class="flex items-center justify-end pt-4 border-t border-gray-200">
            <a href="{{ route('books.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 mr-3">
                Cancelar
            </a>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection