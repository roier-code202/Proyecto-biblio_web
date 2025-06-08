<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Loan;

class LoansExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Loan::with(['user', 'book'])->get()->map(function($loan) {
            return [
                'ID' => $loan->id,
                'Usuario' => $loan->user->name,
                'Libro' => $loan->book->title,
                'Fecha de Inicio' => $loan->start_date,
                'Fecha de Devolución' => $loan->return_date,
                'Estado' => $loan->returned_at ? 'Devuelto' : (now()->gt($loan->return_date) ? 'Atrasado' : 'Pendiente'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Usuario',
            'Libro',
            'Fecha de Inicio',
            'Fecha de Devolución',
            'Estado',
        ];
    }
}