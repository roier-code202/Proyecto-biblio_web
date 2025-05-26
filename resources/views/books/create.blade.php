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
            <label for="genre" class="form-label">Género</label>
            <input type="text" name="genre" id="genre" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Guardar Libro</button>
        <a href="{{ route('books.index') }}" class="btn btn-link">Cancelar</a>
    </form>
</div>
@endsection
