@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Registrar Préstamo</h1>

    <form method="POST" action="{{ route('loans.store') }}" class="space-y-4">
        @csrf

        <div>
            <label for="user_id" class="block text-sm font-medium">Usuario</label>
            <select name="user_id" id="user_id" class="w-full border p-2 rounded" required>
                <option value="">Seleccionar Usuario</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="book_id" class="block text-sm font-medium">Libro</label>
            <select name="book_id" id="book_id" class="w-full border p-2 rounded" required>
                <option value="">Seleccionar Libro</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="start_date" class="block text-sm font-medium">Fecha de Inicio</label>
            <input type="date" name="start_date" id="start_date" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label for="return_date" class="block text-sm font-medium">Fecha de Devolución</label>
            <input type="date" name="return_date" id="return_date" class="w-full border p-2 rounded" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Registrar
        </button>
        <a href="{{ route('loans.index') }}" class="text-gray-600 hover:underline ml-4">Cancelar</a>
    </form>
</div>
@endsection