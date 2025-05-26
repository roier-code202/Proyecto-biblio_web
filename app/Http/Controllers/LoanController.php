<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    // Mostrar todos los préstamos
    public function index()
    {
        $loans = Loan::with('user', 'book')->get();
        return view('loans.index', compact('loans'));
    }

    // Mostrar el formulario de creación de un préstamo
    public function create()
    {
        $users = User::all();
        $books = Book::where('available', 1)->get(); // Solo libros disponibles
        return view('loans.create', compact('users', 'books'));
    }

    // Almacenar un nuevo préstamo
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'start_date' => 'required|date',
            'return_date' => 'required|date|after:start_date',
        ]);

        Loan::create($request->all());
        Book::where('id', $request->book_id)->update(['available' => 0]);

        return redirect()->route('loans.index')->with('success', 'Préstamo creado con éxito.');
    }

    // Mostrar el formulario de edición de un préstamo
    public function edit(Loan $loan)
    {
        return view('loans.edit', compact('loan'));
    }

    // Actualizar un préstamo
    public function update(Request $request, Loan $loan)
    {
        $request->validate([
            'start_date' => 'required|date',
            'return_date' => 'required|date|after:start_date',
        ]);

        $loan->update($request->all());

        return redirect()->route('loans.index')->with('success', 'Préstamo actualizado con éxito.');
    }

    // Eliminar un préstamo
    public function destroy(Loan $loan)
    {
        $loan->book->update(['available' => 1]);
        $loan->delete();

        return redirect()->route('loans.index')->with('success', 'Préstamo eliminado con éxito.');
    }

    // Marcar un préstamo como devuelto
    public function return(Loan $loan)
    {
        if ($loan->returned_at) {
            return redirect()->back()->with('info', 'El libro ya fue devuelto.');
        }

        $loan->returned_at = now();
        $loan->save();

        // Marcar el libro como disponible
        $loan->book->available = true;
        $loan->book->save();

        return redirect()->back()->with('success', 'Libro devuelto correctamente.');
    }
}
