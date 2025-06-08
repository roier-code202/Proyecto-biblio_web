@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Inicio</h2>

    <div class="row">
        <!-- Sección Usuarios -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Usuarios ({{ count($users) }})</h4>
                </div>
                @if($users->isEmpty())
                    <div class="card-body text-muted">No hay usuarios registrados</div>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($users as $user)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $user->name }}</strong>
                                    <div class="text-muted small">{{ $user->email }}</div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <!-- Sección Libros -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">Libros ({{ count($books) }})</h4>
                </div>
                @if($books->isEmpty())
                    <div class="card-body text-muted">No hay libros registrados</div>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($books as $book)
                            <li class="list-group-item">
                                <strong>{{ $book->title }}</strong>
                                <div class="text-muted small">{{ $book->author }}</div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <!-- Sección Préstamos -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h4 class="mb-0">Préstamos ({{ count($loans) }})</h4>
                </div>
                @if($loans->isEmpty())
                    <div class="card-body text-muted">No hay préstamos registrados</div>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($loans as $loan)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold">{{ $loan->user->name ?? 'Usuario eliminado' }}</span>
                                    @if($loan->returned_at)
                                        <span class="badge bg-success">Devuelto</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pendiente</span>
                                    @endif
                                </div>
                                <div class="small">Libro: {{ $loan->book->title ?? 'Libro eliminado' }}</div>
                                <div class="small text-muted">
                                    {{ \Carbon\Carbon::parse($loan->start_date)->format('d/m/Y') }} - 
                                    {{ \Carbon\Carbon::parse($loan->return_date)->format('d/m/Y') }}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
        </a>
    </div>
</div>
@endsection