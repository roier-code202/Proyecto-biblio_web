@extends('layouts.app')

@section('content')
    <h1>Registrar Préstamo</h1>

    <form action="{{ route('loans.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="user_id">Usuario</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">Seleccionar Usuario</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="book_id">Libro</label>
            <select name="book_id" id="book_id" class="form-control" required>
                <option value="">Seleccionar Libro</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="start_date">Fecha de Inicio</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="return_date">Fecha de Devolución</label>
            <input type="date" name="return_date" id="return_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
@endsection
