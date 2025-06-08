@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Lista de Préstamos</h1>
        <div>
            <a href="{{ route('loans.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Registrar Préstamo
            </a>
            <a href="{{ route('books.create') }}" class="btn btn-success ms-2">
                <i class="fas fa-book"></i> Agregar Libro
            </a>
            <a href="{{ route('loans.export.excel') }}" class="btn btn-outline-success mb-3">
                <i class="fas fa-file-excel"></i> Exportar a Excel
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Filtros en tiempo real -->
    <form method="GET" class="row g-3 mb-4" id="filter-form" autocomplete="off">
        <div class="col-md-4">
            <label for="status" class="form-label">Estado</label>
            <select id="status" name="status" class="form-select">
                <option value="">Todos los estados</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pendientes</option>
                <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Devueltos</option>
                <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>Atrasados</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="search" class="form-label">Buscar</label>
            <input type="text" id="search" name="search" class="form-control" placeholder="Buscar por libro o usuario..." value="{{ request('search') }}">
        </div>
    </form>

    <!-- Tabla de préstamos -->
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Libro</th>
                    <th>Género</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Devolución</th>
                    <th>Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody id="loans-table-body">
                @forelse ($loans as $loan)
                    <tr>
                        <td>{{ $loan->id }}</td>
                        <td class="user-cell">{{ $loan->user->name }}</td>
                        <td class="book-cell">{{ $loan->book->title }}</td>
                        <td>{{ $loan->book->genre ? $loan->book->genre->name : '-' }}</td>
                        <td class="start-cell">{{ \Carbon\Carbon::parse($loan->start_date)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($loan->return_date)->format('d/m/Y') }}</td>
                        <td class="status-cell">
                            @if($loan->returned_at)
                                Devuelto
                            @elseif(\Carbon\Carbon::parse($loan->return_date)->isPast())
                                Atrasado
                            @else
                                Pendiente
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="btn-group" role="group">
                                @if(!$loan->returned_at)
                                    <form action="{{ route('loans.return', $loan) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-success" title="Marcar como devuelto">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('loans.destroy', $loan) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar"
                                        onclick="return confirm('¿Estás seguro de eliminar este préstamo?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">No se encontraron préstamos</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('styles')
<style>
    .badge {
        font-size: 0.85em;
    }
    .table th {
        white-space: nowrap;
    }
    .btn-group {
        white-space: nowrap;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search');
    const statusSelect = document.getElementById('status');
    const filterForm = document.getElementById('filter-form');
    const tableBody = document.getElementById('loans-table-body');
    const rows = Array.from(tableBody.querySelectorAll('tr'));

    function filterTable() {
        const search = searchInput.value.toLowerCase();
        const status = statusSelect.value;

        rows.forEach(row => {
            const user = row.querySelector('.user-cell')?.textContent.toLowerCase() || '';
            const book = row.querySelector('.book-cell')?.textContent.toLowerCase() || '';
            const state = row.querySelector('.status-cell')?.textContent.toLowerCase() || '';

            let show = true;

            if (search && !(user.includes(search) || book.includes(search))) {
                show = false;
            }
            if (status) {
                if (status === 'pending' && state !== 'pendiente') show = false;
                if (status === 'returned' && state !== 'devuelto') show = false;
                if (status === 'overdue' && state !== 'atrasado') show = false;
            }
            row.style.display = show ? '' : 'none';
        });
    }

    // Filtrado en tiempo real (frontend)
    searchInput.addEventListener('input', filterTable);

    // Al cambiar el select, envía el formulario (backend)
    statusSelect.addEventListener('change', function() {
        filterForm.submit();
    });

    // Al presionar Enter en buscar, envía el formulario (backend)
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            filterForm.submit();
        }
    });
});
</script>
@endpush