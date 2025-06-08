@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Agregar Libro</h2>
    <form action="{{ route('books.store') }}" method="POST" class="max-w-md bg-white p-4 rounded shadow">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Autor</label>
            <input type="text" name="author" id="author" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="genre_id" class="form-label">Género</label>
            <select name="genre_id" id="genre_id" class="form-select" required>
                <option value="">Seleccione un género</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Libro</button>
        <a href="{{ route('books.index') }}" class="btn btn-link">Cancelar</a>
    </form>
</div>
@endsection
