@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-2xl">
    <h1 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Registrar Nuevo Préstamo</h1>

    <form method="POST" action="{{ route('loans.store') }}" class="bg-white p-6 rounded-lg border border-gray-200">
        @csrf

        <!-- Campo Usuario -->
        <div class="mb-6">
            <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">Usuario *</label>
            <select name="user_id" id="user_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500 @error('user_id') border-red-500 @enderror" required>
                <option value="">Seleccionar Usuario</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} - {{ $user->email }}
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo Libro -->
        <div class="mb-6">
            <label for="book_id" class="block text-sm font-medium text-gray-700 mb-2">Libro *</label>
            <select name="book_id" id="book_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500 @error('book_id') border-red-500 @enderror" required>
                <option value="">Seleccionar Libro</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }} data-available="{{ $book->available ? 'true' : 'false' }}">
                        {{ $book->title }} ({{ $book->author }})
                        @if($book->available)
                            - Disponible
                        @else
                            - No disponible
                        @endif
                    </option>
                @endforeach
            </select>
            @error('book_id')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
            <div id="book-availability" class="mt-2 text-sm"></div>
        </div>

        <!-- Fechas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Fecha de Inicio *</label>
                <input type="date" name="start_date" id="start_date" 
                       value="{{ old('start_date', now()->format('Y-m-d')) }}"
                       min="{{ now()->format('Y-m-d') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500 @error('start_date') border-red-500 @enderror" required>
                @error('start_date')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="return_date" class="block text-sm font-medium text-gray-700 mb-2">Fecha de Devolución *</label>
                <input type="date" name="return_date" id="return_date" 
                       value="{{ old('return_date', now()->addDays(14)->format('Y-m-d')) }}"
                       min="{{ now()->addDay()->format('Y-m-d') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500 @error('return_date') border-red-500 @enderror" required>
                @error('return_date')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Notas/Observaciones -->
        <div class="mb-6">
            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Observaciones</label>
            <textarea name="notes" id="notes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">{{ old('notes') }}</textarea>
        </div>

        <!-- Botones -->
        <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
            <button type="reset" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100 transition">
                Limpiar
            </button>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition">
                Registrar Préstamo
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Validación de fechas
        const startDate = document.getElementById('start_date');
        const returnDate = document.getElementById('return_date');
        
        startDate.addEventListener('change', function() {
            const startDateValue = new Date(this.value);
            const minReturnDate = new Date(startDateValue.getTime() + 86400000); // +1 día
            returnDate.min = minReturnDate.toISOString().split('T')[0];
            
            if (new Date(returnDate.value) < minReturnDate) {
                returnDate.value = minReturnDate.toISOString().split('T')[0];
            }
        });

        // Mostrar disponibilidad del libro
        const bookSelect = document.getElementById('book_id');
        const availabilityInfo = document.getElementById('book-availability');

        bookSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const isAvailable = selectedOption.getAttribute('data-available') === 'true';
            
            if (this.value === "") {
                availabilityInfo.textContent = '';
                availabilityInfo.className = 'mt-2 text-sm';
            } else if (isAvailable) {
                availabilityInfo.textContent = '✔ Este libro está disponible';
                availabilityInfo.className = 'mt-2 text-sm text-green-600';
            } else {
                availabilityInfo.textContent = '✖ Este libro no está disponible actualmente';
                availabilityInfo.className = 'mt-2 text-sm text-red-600';
            }
        });

        // Disparar el evento change al cargar la página si hay un libro seleccionado
        if (bookSelect.value !== "") {
            bookSelect.dispatchEvent(new Event('change'));
        }
    });
</script>
@endpush