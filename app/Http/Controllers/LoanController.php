<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    // Mostrar todos los préstamos
    public function index()
    {
        // Obtener todos los préstamos y pasarlos a la vista
        $loans = Loan::with('user', 'book')->get();
        return view('loans.index', compact('loans'));
    }

    // Mostrar el formulario de creación de un préstamo
    public function create()
    {
        return view('loans.create');
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
        $loan->delete();

        return redirect()->route('loans.index')->with('success', 'Préstamo eliminado con éxito.');
    }
}
